<template>
    <div
      class="modal fade"
      id="kt_modal_add_propertytype"
      ref="addPropertyTypeModalRef"
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
            <h2 class="fw-bold">{{translate('addpropertytype')}}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_add_propertytype_close"
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
            @submit.prevent="submit()"
            :model="newItem"
            :rules="rules"
            ref="formRef"
          >
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
              <!--begin::Scroll-->
              <div
                class="scroll-y me-n7 pe-7"
                id="kt_modal_add_propertytype_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_add_propertytype_header"
                data-kt-scroll-wrappers="#kt_modal_add_propertytype_scroll"
                data-kt-scroll-offset="300px"
              >
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="required fs-6 fw-semobold mb-2">{{translate('name')}}({{translate('arabic')}})</label>
                  <el-form-item prop="name_ar">
                    <el-input
                      v-model="newItem.name_ar"
                      type="text"
                      name="name_ar"
                      placeholder=""
                    />
                  </el-form-item>
                </div> 
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fs-6 fw-semobold mb-2">{{translate('name')}}({{translate('english')}})</label>
                  <el-form-item prop="name_en">
                    <el-input
                      v-model="newItem.name_en"
                      type="text"
                      name="name_en"
                      placeholder=""
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
                id="kt_modal_add_propertytype_cancel"
                class="btn btn-light me-3"
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
                  {{translate('pleasewait')}}
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
import { translate } from "element-plus";
import { useI18n } from "vue-i18n";



   
  interface newItem{
        name_en:string;
        name_ar:string;
  }


  export default defineComponent({
    name: "add-propertytype-modal",
    components: {},
    props:['propertytype'],
   

    setup(props, {emit}) {
      const formRef = ref<null | HTMLFormElement>(null);
      const addPropertyTypeModalRef = ref<null | HTMLElement>(null);
      const loading = ref<boolean>(false);
      const successmessage=ref<boolean>(false);
        const { t, te } = useI18n();
        const user_id = localStorage.getItem('logged_user_id')  as string;
        const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };
      const newItem = ref<newItem>({ name_en:'',
        name_ar:''});
      const rules = ref({
        name_ar: [
          {
            required: true,
            message: translate('name_ar_req'),
            trigger: "change",
          },
        ],
        // name_en: [
        //   {
        //     required: true,
        //     message: translate('name_en_req'),
        //     trigger: "change",
        //   },
        // ],
      });
  
      const submit = () => {
        if (!formRef.value) {
          return;
        }
             const array = [props.propertytype];
            // let a1="";
        formRef.value.validate((valid: boolean) => {
          if (valid) {
            // const date = new Date();
         //   let data = 30;
            loading.value = true;
            ApiService.post("createPropertyType", {
                name_en: newItem.value.name_en,
                name_ar:newItem.value.name_ar,
                user_id:user_id})
        .then(({ data }) => 
            {
              props.propertytype.push({
                "id": data.id,
                  "name_ar": newItem.value.name_ar,
                  "name_en": newItem.value.name_en,
                  'user_id':user_id,
                  'is_deleted': "0",
                  'status':"1",
                })
              
      

      setTimeout(() => {
              loading.value = false;
              formRef.value?.resetFields();
              newItem.value = {
                name_ar: "",
                name_en: "",
              };
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
                hideModal(addPropertyTypeModalRef.value);
              });
            }, 2000);  

             })
              
              .catch(({ response }) => {
              });
            }
        });
      };
  
      return {
        newItem,
        rules,
        submit,
        formRef,
        loading,
        addPropertyTypeModalRef,
        translate,
      };
    },
  });
  </script>
  