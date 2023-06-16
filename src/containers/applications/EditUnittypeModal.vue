<template>
    <div
      class="modal fade"
      id="kt_modal_edit_unittype"
      ref="editUnittypeModalRef"
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
            <h2 class="fw-bold"> {{translate('editunittype')}}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_edit_unittype_close"
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
          @submit.prevent="saveunit()"
            :model="unit"
            :rules="rules"
            ref="formRef"
          >
          
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
              <!--begin::Scroll-->
              <div
                class="scroll-y me-n7 pe-7"
                id="kt_modal_edit_unittype_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_edit_unittype_header"
                data-kt-scroll-wrappers="#kt_modal_edit_unittype_scroll"
                data-kt-scroll-offset="300px"
              >
                <!--begin::Input group-->
               
                  <!--begin::Label-->
                  <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="required fs-6 fw-semobold mb-2">{{ translate('typeunit') }}({{translate('arabic')}})</label>
                  <el-form-item prop="unit_type_ar">
                    <el-input
                      v-model="unit.unit_type_ar"
                      type="text"
                      name="unit_type_ar"
                      :placeholder="translate('placeunittype')" 
                    />
                  </el-form-item>
                
                </div>
                 <!--begin::Label-->
                 <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fs-6 fw-semobold mb-2">{{ translate('typeunit') }}({{translate('english')}})</label>
                  <el-form-item prop="unit_type">
                    <el-input
                      v-model="unit.unit_type_en"
                      type="text"
                      name="unit_type_en"
                      :placeholder="translate('placeunittype')" 
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
                id="kt_modal_edit_unittype_cancel"
                class="btn btn-light me-3"
                @click="cancelunit"
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
  import { defineComponent, onMounted, ref } from "vue";
  import { hideModal } from "@/core/helpers/dom";
  import Swal from "sweetalert2";
import ApiService from "@/core/services/ApiService";
import router from "@/router";
import { useI18n } from "vue-i18n";
interface unit{
  unit_type_ar:string;
  unit_type_en:string;
        status:string;  
       
  }
// interface unit{
//       id:number;
//       type:string|any;
//       is_deleted:string;
//       status:string;
     

// }
  export default defineComponent({
    name: "edit-unittype-modal",
    components: {},
    props:['items', 'id', "editdata", 'edittype'],
    emit:['update'],
   

    setup(props, {emit}) {
      const selectedItems = ref([props.items]);
      const { t, te } = useI18n();
      const formRef = ref<null | HTMLFormElement>(null);
      const editUnittypeModalRef = ref<null | HTMLElement>(null);
      const loading = ref<boolean>(false);
      const successmessage=ref<boolean>(false);
       
      const unit = ref<unit>({
        unit_type_ar:'',
        unit_type_en:'',
          status:'',
         
      });

      const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

      const rules = ref({
        unit_type_ar: [
          {
            required: true,
            message: translate('requnittype'),
            trigger: "change",
          },
        ],
      });

      onMounted(async() => {
       
        if(props.id){
          console.log('edit', unit.value)
      //   await ApiService.post("showUnitsTypesId",{'id': props.id  })
      // .then(({ data }) => {
      //   console.log('edidatat', data[0])
      //   unit.value = data[0];
      // })
      if(props.editdata){
        console.log(props.editdata);
        unit.value = await props.editdata;
        // unit.value.status = await props.editdata.status;
      }
      console.log('unit.value', unit.value)
    }
      // 
      
      });


      const cancelunit = () =>
       {
          unit.value.unit_type_ar="";
          unit.value.unit_type_en="";
          hideModal(editUnittypeModalRef.value);
       }
   
       const saveunit = () => {
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
            ApiService.post("updateUnitType", {unit_type_ar:unit.value.unit_type_ar, unit_type_en:unit.value.unit_type_en, id:props.id})
        .then(({ data }) => 
            {
                props.items.push({
              type:data.type,
              type_en:data.type_en,
              status:'1',
             id:data.id
           })
           setTimeout(() => {
              loading.value = false;
              
              // formRef.value?.resetFields();
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
                hideModal(editUnittypeModalRef.value);
              });
            }, 2000); 
            });
              
            //   .catch(({ response }) => {
            //   });
          }
       
        });
      };
    
  
  
      return {
        cancelunit,
        saveunit,
        rules,
        formRef,
        loading,
        editUnittypeModalRef,
        unit,
        translate
      };
    },
  });
  </script>
  