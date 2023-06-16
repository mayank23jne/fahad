<template>
    <div
      class="modal fade"
      id="kt_modal_edit_contractor"
      ref="editContractorModalRef"
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
            <h2 class="fw-bold">{{ translate('editcontractor') }}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_edit_contractor_close"
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
          @submit.prevent="savecontractor()"
            :model="company"
            :rules="rules"
            ref="formRef"
          >
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
              <!--begin::Scroll-->
              <div
                class="scroll-y me-n7 pe-7"
                id="kt_modal_edit_contractor_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_edit_contractor_header"
                data-kt-scroll-wrappers="#kt_modal_edit_contractor_scroll"
                data-kt-scroll-offset="300px"
              >
                <!--begin::Input group-->
               
                  <!--begin::Label-->
                  <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="required fs-6 fw-semobold mb-2">{{ translate('contractorname') }}</label>
                  <el-form-item prop="company_name">
                    <el-input
                      v-model="company.company_name"
                      type="text"
                      name="company_name"
                      :placeholder=" translate('placecontractor') "
                    />
                  </el-form-item>
                  <el-form-item prop="id">
                    <el-input
                      v-model="company.id"
                      type="hidden"
                      name="id"
                      :placeholder=" translate('placecontractor') "
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
                id="kt_modal_edit_contractor_cancel"
                class="btn btn-light me-3"
                @click="cancelprocess"
              >
              {{ translate('cancel') }}
              </button>
              <!--end::Button-->
  
              <!--begin::Button-->
              <button
                :data-kt-indicator="loading ? 'on' : null"
                class="btn btn-lg btn-primary"
                type="submit"
             
              >
                <span v-if="!loading" class="indicator-label">
                    {{ translate('save') }}
                  <span class="svg-icon svg-icon-3 ms-2 me-0">
                    <inline-svg src="/media/icons/duotune/arrows/arr064.svg" />
                  </span>
                </span>
                <span v-if="loading" class="indicator-progress">
                  Please wait...
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
  import { defineComponent, onMounted, ref } from "vue";
  import { hideModal } from "@/core/helpers/dom";
  import Swal from "sweetalert2";
import ApiService from "@/core/services/ApiService";
import router from "@/router";
import { useI18n } from "vue-i18n";


interface company{
    company_name:string;
    id:string;
}
  export default defineComponent({
    name: "edit-contractor-modal",
    components: {},
    props:['items', 'id', "editdata"],
    emit:['update'],
    setup(props, {emit}) {
        // const data = ref(props.editdata);
        const selectedItems = ref([props.items]);
      const { t, te } = useI18n();
      const formRef = ref<null | HTMLFormElement>(null);
      const editContractorModalRef = ref<null | HTMLElement>(null);
      const loading = ref<boolean>(false);
      const successmessage=ref<boolean>(false);
       
    //   const toggleItem = (event, itemId) => {
    //       emit('toggle-item', event, itemId)
    //         }

      const company = ref<company>({
        company_name:"",
        id:'',
      });
      
      const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

    
      const rules = ref({
        company_name: [
          {
            required: true,
            message:translate('reqcon'),
            trigger: "change",
          },
        ],
      });

      onMounted(async() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
        // ApiService.setHeader();
      //   if(props.id!=""){
      //   await ApiService.get(`showCompanyId/${props.id}`)
      // .then(({ data }) => {
      //   if(data !=""){
      //     company.value.company_name = data.company_name;
      //     company.value.id = data.id;
      //   }
      // });}

  
        company.value.company_name =await props.editdata.company_name;
         
      
     
      });

      const cancelprocess = () =>
       {
        company.value.company_name="";
          hideModal(editContractorModalRef.value);

       }
   
       const savecontractor = () => {
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
            
        //     ApiService.post("addCompany", {company_name:company.value.company_name})
        // .then(({ data }) => 
        //     {
        //         props.items.push({
        //      company_name:data.company_name,
        //      id:data.id
        //    })
        //    setTimeout(() => {
        //       loading.value = false;
              
            
        //       Swal.fire({
        //         text: translate('savesuccess'),
        //         icon: "success",
        //         buttonsStyling: false,
        //         confirmButtonText: translate('okgotit'),
        //         heightAuto: false,
        //         customClass: {
        //           confirmButton: "btn btn-primary",
        //         },
        //       }).then(() => {
        //         hideModal(editContractorModalRef.value);
        //       });
        //       company.value = {
        //         company_name: "",
        //       }
        //     }, 2000); 
        //     });
              
            //   .catch(({ response }) => {
            //   });
          }
       
        });
      };
      
  
  
      return {
        cancelprocess,
        savecontractor,
        rules,
        formRef,
        loading,
        editContractorModalRef,
        translate,
        company,
       
      };
    },
  });
  </script>
  