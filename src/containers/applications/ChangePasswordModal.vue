<template>
    <div
      class="modal fade"
      id="kt_modal_change_password"
      ref="changePasswodModalRef"
      tabindex="-1"
      aria-hidden="true"
    >
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
          <!--begin::Modal header-->
          <div class="modal-header" id="kt_modal_add_customer_header">
            <!--begin::Modal title-->
            <h2 class="fw-bold">{{ translate('changepassword') }}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_change_password_close"
              data-bs-dismiss="modal"
              class="btn btn-icon btn-sm btn-active-icon-primary"
            >
              <span class="svg-icon svg-icon-1">
                <inline-svg src="/media/icons/duotune/arrows/arr061.svg" />
              </span>
            </div>
            <!--end::Close-->
          </div>
          <!--end::Modal header-->
          <!--begin::Form-->
          <el-form
          @submit.prevent="savecategory()"
            :model="password"
            :rules="rules"
            ref="formRef"
          >
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
              <!--begin::Scroll-->
              <div
                class="scroll-y me-n7 pe-7"
                id="kt_modal_change_password_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_change_password_header"
                data-kt-scroll-wrappers="#kt_modal_change_password_scroll"
                data-kt-scroll-offset="300px"
              >
                <!--begin::Input group-->
               
                  <!--begin::Label-->
                  <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="required fs-6 fw-semobold mb-2">{{ translate('newpassword') }}</label>
                  <el-form-item prop="newpassword">
                    <el-input
                      v-model="password.newpassword"
                      type="text"
                      name="password"
                      :placeholder="translate('enterpassword')" 
                    />
                  </el-form-item>
                
                </div>
              </div>
              <!--end::Scroll-->
            </div>
            <!--end::Modal body-->
  
            <!--begin::Modal footer-->
            <div class="modal-footer flex-center">
              <!--begin::Button-->
              <button
                type="reset"
                id="kt_modal_change_password_cancel"
                class="btn btn-light me-3"
                @click="cancelprocess"
              >
              {{translate('cancel')}}
              </button>
              <!--end::Button-->
  
              <!--begin::Button-->
              <button
                :data-kt-indicator="loading ? 'on' : null"
                class="btn btn-lg btn-primary"
                type="submit"
             
              >
                <span v-if="!loading" class="indicator-label">
                    {{translate('save')}}
                  <span class="svg-icon svg-icon-3 ms-2 me-0">
                    <inline-svg src="/media/icons/duotune/arrows/arr064.svg" />
                  </span>
                </span>
                <span v-if="loading" class="indicator-progress">
                 {{ translate('pleasewait') }}
                  <span
                    class="spinner-border spinner-border-sm align-middle ms-2"
                  ></span>
                </span>
              </button>
              <!--end::Button-->
            </div>
            <!--end::Modal footer-->
          </el-form>
          <!--end::Form-->
        </div>
      </div>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref } from "vue";
  import { hideModal } from "@/core/helpers/dom";
  import Swal from "sweetalert2";
import ApiService from "@/core/services/ApiService";
import router from "@/router";
import { useI18n } from "vue-i18n";

interface password{
    newpassword:string;
}
  export default defineComponent({
    name: "change-password-modal",
    components: {},
    props:['items', 'id'],
   

    setup(props) {
        console.log('props', props.id);
      const formRef = ref<null | HTMLFormElement>(null);
      const changePasswodModalRef = ref<null | HTMLElement>(null);
      const loading = ref<boolean>(false);
      const successmessage=ref<boolean>(false);
        const { t, te } = useI18n();

      const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };


      const password = ref<password>({
        newpassword:"",
      });
      const rules = ref({
        category: [
          {
            required: true,
            message: translate('passreq'),
            trigger: "change",
          },
        ],
      });

      const cancelprocess = () =>
       {
        password.value.newpassword="";
          hideModal(changePasswodModalRef.value);

       }
   
       const savecategory = () => {
        if (!formRef.value) {
          return;
        }
     
            //  const array = [props.surveydata];
            // let a1="";
        formRef.value.validate((valid: boolean) => {
          if (valid) {
            // const date = new Date();
         //   let data = 30;
            loading.value = true;
            ApiService.post("changePassword", {password:password.value.newpassword, id:props.id})
        .then(({ data }) => 
            {
            //     props.items.push({
            //     password:password.value.newpassword,
            //     id:data.id
            //   })
           setTimeout(() => {
              loading.value = false;
              password.value = {
                newpassword: "",
              }
             
            formRef.value?.resetFields('category');
              Swal.fire({
                text: translate('savesuccess'),
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: translate('okgotit'),
                heightAuto: false,
                customClass: {
                  confirmButton: "btn btn-primary",
                },
              }).then(() => {
               
                hideModal(changePasswodModalRef.value);
              });
            }, 2000); 
            });
              
            //   .catch(({ response }) => {
            //   });
          }
       
        });
      };
    
  
  
      return {
        cancelprocess,
        savecategory,
        rules,
        formRef,
        loading,
        changePasswodModalRef,
        password,
        translate
      };
    },
  });
  </script>
  