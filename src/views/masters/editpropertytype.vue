<template>
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
      <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <VForm
        id="kt_account_profile_details_form"
        class="form"
        novalidate
        @submit="formSubmit()"
        :validation-schema="profileDetailsValidator"
         
        >
          <!--begin::Card body-->
          <div class="card-body border-top p-9">
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{translate('name')}}({{translate('arabic')}})</label
              >
              <div class="col-lg-8">
                <!--begin::Row-->
                
                    <Field
                      type="text"
                      name="name_ar"
                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                      :placeholder="translate('name')"
                      v-model="newItem.name_ar"
                     
                    />
                    <div class="fv-plugins-message-container">
                      <div class="fv-help-block">
                        <ErrorMessage name="name_ar" />
                      </div>
                    </div>
              
               
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
  
            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label  fw-semobold fs-6"
              >{{translate('name')}}({{translate('english')}})</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="name_en"
                  class="form-control form-control-lg   form-control-solid"
                  :placeholder="translate('name')"
                  v-model="newItem.name_en"
                
                />
                <!-- <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="name_en" />
                  </div>
                </div> -->
              </div>
              <!--end::Col-->
            </div>
        
          </div>
        
          <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button
              type="reset"
              class="btn btn-light btn-active-light-primary me-2"
            >
              {{translate("discard")}}
            </button>
            <button
            type="submit"
            id="kt_account_profile_details_submit"
            ref="submitButton1"
            class="btn btn-primary"
          >
            <span class="indicator-label"> {{translate('save')}} </span>
            <span class="indicator-progress">
             {{translate('pleasewait')}}
              <span
                class="spinner-border spinner-border-sm align-middle ms-2"
              ></span>
            </span>
          </button>
           
          </div>
          <!--end::Actions-->
        </VForm>
        <!--end::Form-->
      </div>
      <!--end::Content-->
    </div>
    <!--end::Basic info-->
  
  
  </template>
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import { ErrorMessage, Field, Form as VForm } from "vee-validate";
  import ApiService from "@/core/services/ApiService";
  import router from "@/router";
  import Swal from "sweetalert2";
  import * as Yup from "yup";
import { translate } from "element-plus";
import { useI18n } from "vue-i18n";
  
interface newItem{
        name_en:string;
        name_ar:string;
  }
 
  export default defineComponent({
    name: "editpropertytype",
   props:['id'],
    components: {
      ErrorMessage,
      Field,
      VForm,
    },
  
    setup(props) {
      const { t, te } = useI18n();
    const submitButton1 = ref<HTMLElement | null>(null);
      const user_id = localStorage.getItem('logged_user_id')  as string;
    const newItem = ref<newItem>({ name_en:'',
        name_ar:''});

         const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

         const profileDetailsValidator = Yup.object().shape({
          name_ar: Yup.string().required(translate('name_ar_req')),
          // name_en: Yup.string().required(translate('name_en_req')),
          
    });


   


      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
        ApiService.post("showPropertyTypeId",{id:props.id, user_id:user_id})
    .then(({ data }) => {
        newItem.value.name_ar = data[0].name_ar;
        newItem.value.name_en = data[0].name_en
    });
     
      });
    
      const saveChanges1 = () => {
      if (submitButton1.value) {
        submitButton1.value.setAttribute("data-kt-indicator", "on");

        setTimeout(() => {
          submitButton1.value?.removeAttribute("data-kt-indicator");
        }, 2000);
      }
    };

      const formSubmit=()=> {
        if (submitButton1.value) {
        // Activate indicator
        submitButton1.value.setAttribute("data-kt-indicator", "on");

        const data = new FormData();
        data.append("name_en", newItem.value.name_en);
        data.append("name_ar", newItem.value.name_ar);
        data.append('user_id', user_id);
        data.append('id', props.id);
        ApiService.post("updatePropertyType", data)
      .then(({ data }) => {  
      setTimeout(() => {
        Swal.fire({
          text: translate("savedsuccess"),
          icon: "success",
          buttonsStyling: false,
          confirmButtonText: translate('okgotit'),
          heightAuto: false,
          customClass: {
            confirmButton: "btn btn-primary",
          },
        }).then(() => {
          router.push({ name: "propertytype" });
        });
      }, 2000);
      
    });
   
      setTimeout(() => {
          submitButton1.value?.removeAttribute("data-kt-indicator");
        }, 2000);
      }
  
      }
     
      const search = ref<string>("");
      
  
      return {
        submitButton1,
        saveChanges1,
        newItem,
         formSubmit,
         profileDetailsValidator,
         translate,
      
      };
    },
  });
  </script>
  <style>
.fv-help-block{
  color: #d72626;
}
</style>