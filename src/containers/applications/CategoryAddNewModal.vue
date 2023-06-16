<template>
    <div
      class="modal fade"
      id="kt_modal_add_category"
      ref="addCategoryModalRef"
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
            <h2 class="fw-bold">{{ translate('addrolegroup') }}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_add_category_close"
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
            :model="category"
            :rules="rules"
            ref="formRef"
          >
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
              <!--begin::Scroll-->
              <div
                class="scroll-y me-n7 pe-7"
                id="kt_modal_add_category_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_add_category_header"
                data-kt-scroll-wrappers="#kt_modal_add_category_scroll"
                data-kt-scroll-offset="300px"
              >
                <!--begin::Input group-->
               
                  <!--begin::Label-->
                  <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="required fs-6 fw-semobold mb-2">{{ translate('deparmentname') }} ({{ translate('arabic') }})</label>
                  <el-form-item prop="category_ar">
                    <el-input
                      v-model="category.category_ar"
                      type="text"
                      name="category_ar"
                      :placeholder="translate('placecontractor')" 
                    />
                  </el-form-item>
                
                </div>
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fs-6 fw-semobold mb-2">{{ translate('deparmentname') }} ({{ translate('english') }})</label>
                  <el-form-item prop="category_en">
                    <el-input
                      v-model="category.category_en"
                      type="text"
                      name="category_en"
                      :placeholder="translate('placecontractor')" 
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
                id="kt_modal_add_category_cancel"
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

interface category{
    category_ar:string;
    category_en:string;
}
  export default defineComponent({
    name: "add-category-modal",
    components: {},
    props:['items'],
   

    setup(props) {
      const formRef = ref<null | HTMLFormElement>(null);
      const addCategoryModalRef = ref<null | HTMLElement>(null);
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


      const category = ref<category>({
        category_ar:"",
        category_en:"",
      });
      const rules = ref({
        category_ar: [
          {
            required: true,
            message: translate('reqcat'),
            trigger: "change",
          },
        ],
      });

      const cancelprocess = () =>
       {
        category.value.category_ar="";
        category.value.category_en="";
          hideModal(addCategoryModalRef.value);

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
            ApiService.post("category/create", {category:category.value.category_ar,
              category_en:category.value.category_en})
        .then(({ data }) => 
            {
                props.items.push({
                category:category.value.category_ar,
                category_en:category.value.category_en,
                id:data.id,
                status:'1',
              })
           setTimeout(() => {
              loading.value = false;
              category.value = {
                category_ar: "",
                category_en: "",
              }
             
              formRef.value?.resetFields();
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
               
                hideModal(addCategoryModalRef.value);
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
        addCategoryModalRef,
        category,
        translate
      };
    },
  });
  </script>
  