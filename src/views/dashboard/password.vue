<template>
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
      <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <VForm
        id="kt_account_profile_details_form"
        class="form"
        novalidate
        @submit="saveChanges1"
        :validation-schema="profileDetailsValidator"
        >
          <!--begin::Card body-->
          <div class="card-body border-top p-9">
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              > {{ $t('newpass') }}</label
              >
              <div class="col-lg-8">
                <!--begin::Row-->

                    <Field
                      type="password"
                      name="newpassword"
                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                      :placeholder="$t('password')"
                      v-model="password.newpassword"
                     
                    />
                    <div class="fv-plugins-message-container">
                      <div class="fv-help-block">
                        <ErrorMessage name="newpassword" />
                      </div>
                    </div>
              
               
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
  
           </div>
          <!--begin::Actions-->
          <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button
              type="reset"
              class="btn btn-light btn-active-light-primary me-2"
              id="discard"
              name="discard"
            >
              {{$t('discard')}}
            </button>
            <button
            type="submit"
            id="kt_account_profile_details_submit"
            ref="submitButton1"
            class="btn btn-primary"
          >
            <span class="indicator-label"> {{$t("save")}} </span>
            <span class="indicator-progress">
              {{$t('pleasewait')}}
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
  import router from "@/router";
  import Swal from "sweetalert2";
  import * as Yup from "yup";
  import type { App } from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import JwtService from "@/core/services/JwtService";
import type { AxiosResponse } from "axios";
import { ClickOutside, translate } from "element-plus";
import { useI18n } from "vue-i18n";
import ApiService from "@/core/services/ApiService";
  
  interface password{
      newpassword: string;
      id:number | any;
  }
 
  export default defineComponent({
    name: "password",
   // props:['id'],
    components: {
      ErrorMessage,
      Field,
      VForm,
    },
  
    setup(props) {
      const { t, te } = useI18n();
    const submitButton1 = ref<HTMLElement | null>(null);
       const units=ref([]);
       const password=ref<password>({
        newpassword: '',
        id:localStorage.getItem('logged_user_id')
        });
      
        const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

         const profileDetailsValidator = Yup.object().shape({
          newpassword: Yup.string().required(translate('newpassreq')).min(6, translate('passwordless')),
          
    });
   
    

  
    
      const saveChanges1 = (values, { resetForm }) => {
      if (submitButton1.value) {
     
        submitButton1.value.setAttribute("data-kt-indicator", "on");
        let token=localStorage.getItem('access_token');
  
    const data = new FormData();
        
        data.append("id", password.value.id);
        data.append("newpassword", password.value.newpassword);
   
    ApiService.vueInstance.axios.defaults.headers.common[
      "Authorization"
    ] =  `Bearer ${token}`;
        ApiService.post("admin/resetpassword", data)
    // axios.post('https://forms.innovativeideasbox.com/API/api/admin/resetpassword',data,{headers:
    //       {
    //         'Authorization': `Bearer ${localStorage.getItem('access_token')}`
    //       }})
      .then(({ data }) => {
        setTimeout(() => {
          Swal.fire({
            text: translate('passwordsave'),
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: translate('okgotit'),
            heightAuto: false,
            customClass: {
              confirmButton: "btn btn-primary",
            },
          }).then(() => {
            // password.value={
            //   newpassword:'',
            //   id:localStorage.getItem('logged_user_id')
            // };
            resetForm();
            
          });
        }, 2000);
        
      })
      .catch(({ response }) => {
        // setError(response.data.errors);\
        if(response.status === 401){
          setTimeout(() => {
          Swal.fire({
            text: translate('pleasetry'),
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: translate('okgotit'),
            heightAuto: false,
            customClass: {
              confirmButton: "btn btn-primary",
            },
          }).then(() => {
            resetForm();
          });
        }, 2000);
        }
      });

        setTimeout(() => {
          submitButton1.value?.removeAttribute("data-kt-indicator");
        
        }, 2000);
      }
      
    };

     
     
      const search = ref<string>("");
      
  
      return {
        submitButton1,
        saveChanges1,
       password, 
         profileDetailsValidator
      
      };
    },
  });
  </script>
   <style>
   .fv-help-block{
     color: #d72626;
   }
   </style>