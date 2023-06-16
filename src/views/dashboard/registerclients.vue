<template>
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
      <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <VForm
        id="kt_account_profile_details_form"
        class="form"
        novalidate
        @submit="formSubmit"
        :validation-schema="profileDetailsValidator"
        >
          <!--begin::Card body-->
          <div class="card-body border-top p-9">
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{ translate('firstname') }}</label
              >
              <div class="col-lg-8">
                <!--begin::Row-->
                
                    <Field
                      type="text"
                      name="firstname"
                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                      :placeholder="translate('firstname')"
                      v-model="newclient.firstname"
                     
                    />
                    <div class="fv-plugins-message-container">
                      <div class="fv-help-block">
                        <ErrorMessage name="firstname" />
                      </div>
                    </div>
              
               
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
  
            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{ translate('lastname') }}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="lastname"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('lastname')"
                  v-model="newclient.lastname"
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="lastname" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
  
            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label  fw-semobold fs-6">
                <span class="required">{{ translate('nationality') }} </span>
              </label>
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="nationality"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('nationality')"
                  v-model="newclient.nationality"
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="nationality" />
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
                >{{translate('e_mail')}}</label
              >
              <!--end::Label-->
   
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="email"
                  name="email"
                  class="form-control form-control-lg   form-control-solid"
                  :placeholder="translate('e_mail')"
                  v-model="newclient.email"
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="email" />
                  </div>
                </div>
              </div>
              
              <!--end::Col-->
            </div>
            <!--end::Input group-->
              <!--begin::Input group-->
              <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{ translate('phone') }}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="mobile"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('phone')"
                  v-model="newclient.mobile"
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="mobile" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
             
             <!--begin::Input group-->
             <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{ translate('password') }} </label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="password"
                  name="password"
                  class="form-control form-control-lg form-control-solid"
                  :placeholder=" translate('password')"
                  v-model="newclient.password"
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="password" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label fw-semobold fs-6">
                <span class="required">{{ translate('selectdegree') }}</span>
              </label>
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  as="select"
                  name="role_name"
                  class="form-select form-select-solid form-select-lg fw-semobold"
                  v-model="newclient.role_id" 
                  :options="roles"
                >
                <template v-for="role in roles" :key="role.id">
                  <option :value="role.id">{{ role.role_name }}</option>
                </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="role_name" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
             <div class="row mb-6">
              
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{ translate('choosecategory') }}</label
              >
  
              <div class="col-lg-8 fv-row">
               
                <Field
                  as="select"
                  name="category"
                  class="form-select form-select-solid form-select-lg"
                  v-model="newclient.category_id" 
                  :options="categories"
                >
                <template v-for="cat in categories" :key="cat.id">
                  <option :value="cat.id">{{ cat.category }}</option>
                </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="category" />
                  </div>
                </div>
              </div>
              
            </div> 
            <div class="row mb-6" v-if="newclient.role_id=='14' || newclient.role_id=='15'">
           
              <label class="col-lg-4 col-form-label required fw-semobold fs-6">
             {{ translate('selectcontractor') }}</label>
              <div class="col-lg-8 fv-row">
                <Field
                  as="select"
                  name="type"
                  class="form-select form-select-solid form-select-lg"
                  v-model="newclient.company" :options="compainies"
                >
                <template v-for="company in compainies" :key="company.id">
                  <option :value="company.id">{{ company.company_name }}</option>
                </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="type" />
                  </div>
                </div>
              </div>
            
            </div>
          </div>
          <!--end::Card body-->
  
          <!--begin::Actions-->
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
            <span class="indicator-label"> {{translate('registration')}} </span>
            <span class="indicator-progress">
             {{translate('pleasewait')}}
              <span
                class="spinner-border spinner-border-sm align-middle ms-2"
              ></span>
            </span>
          </button>
            <!-- <button
              type="submit"
              id="kt_account_profile_details_submit"
            ref="submitButton1"
              class="btn btn-primary"
            >
              <span class="indicator-label">تسجيل</span>
              <span class="indicator-progress">
                Please wait...
                <span
                  class="spinner-border spinner-border-sm align-middle ms-2"
                ></span>
              </span>
            </button> -->
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
  
  interface newclient{
      firstname: string;
      lastname:string;
      email: string;
      password: string;
      mobile:string;
      role_id:string;
      nationality:string;
      company:string;
      category_id:string;
  }
  interface compainies{
    id:number |any;
    company_name:string|any;
  }
  interface categories{
    id:number|any;
    category:string|any;
  }
  interface roles{
    id:number|any;
    role_name:string|any;
  }


  export default defineComponent({
    name: "register",
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
       const newclient=ref<newclient>({
        firstname: '',
        lastname: '',
        email: '',
        password: '',
        mobile:"",
        role_id:"",
        nationality:"",
        company:"",
        category_id:"",
        });
        const compainies=ref<compainies>({
            id:0,
            company_name:'',
        });
        const categories=ref<categories>({
            id:0,
            category:'',
        });
         const roles=ref<roles>({
            id:0,
            role_name:'',
         });
        
         const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

         const profileDetailsValidator = Yup.object().shape({
          firstname: Yup.string().required(translate('firstnamereq')),
          lastname: Yup.string().required(translate('lastnamereq')),
          nationality: Yup.string().required(translate('nationalityreq')),
          // email: Yup.string().required(translate('emailreq')),
          mobile: Yup.string().required(translate('mobilereq')),
          password: Yup.string().required(translate('passreq')).min(6, translate('passless')),
          role_name: Yup.string().required(translate('rolereq')),
           category: Yup.string().required(translate('catreq')),
          // type: Yup.string().required().label("type"),
    });


   


      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
         ApiService.get("showRoles")
      .then(({ data }) => {
        roles.value = data;
      });
  
      ApiService.get("showCompanies")
      .then(({ data }) => {
        compainies.value = data.data;
         
      });
  
      ApiService.get("category")
      .then(({ data }) => {
        categories.value = data;
       
      });
     
      });
    
      const saveChanges1 = (values, { resetForm }) => {
      if (submitButton1.value) {
        submitButton1.value.setAttribute("data-kt-indicator", "on");
        resetForm();
        setTimeout(() => {
          submitButton1.value?.removeAttribute("data-kt-indicator");
        }, 2000);
      }
    };

      const formSubmit=(values, { resetForm })=> {
    
        if (submitButton1.value) {
        // Activate indicator
        submitButton1.value.setAttribute("data-kt-indicator", "on");

       
        const data = new FormData();
        data.append("firstname", newclient.value.firstname);
        data.append("lastname", newclient.value.lastname);
        data.append("email", newclient.value.email!=="" ? newclient.value.email : "");
        data.append("password", newclient.value.password);
        data.append("mobile", newclient.value.mobile);
        data.append("role_id", newclient.value.role_id );
        data.append("nationality", newclient.value.nationality);
        data.append("is_active", '1');
        data.append("company", newclient.value.company);
        data.append("category_id", newclient.value.category_id);

  
        ApiService.post("admin/create", data)
      .then(({ data }) => {
        // newclient.value.firstname = "";
        //   newclient.value.lastname = "";
        //   newclient.value.email = "";
        //   newclient.value.password = "";
        //   newclient.value.mobile = "";
        //   newclient.value.role_id = "";
        //   newclient.value.nationality = "";
        //   newclient.value.company = "";
          
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
             resetForm();
            router.push({ name: "usersupdate" });
          });
        }, 2000);
        
      })
      .catch(({response})=>{
        let data = JSON.stringify(response.data);
       
//       var val = Object.values(response.data).forEach((value) => {
//   console.log('value',value)
//        return value;
// }); 
// console.log('afsasfasf', val)

// for (const key in response.data) {
//   console.log(key);
// }

        //  let data1 = [response.data];
        //  let data2 = [data1[0]];
        // console.log('register',data2[0].length ,data2
        // )
        // console.log('register', data1[0].email, data1[0].phone )
       
    //     <div v-for="(errorArray, idx) in notifmsg" :key="idx">
    // <div v-for="(allErrors, idx) in errorArray" :key="idx">
    //     <span class="text-danger">{{ allErrors}} </span>
    // </div>
    //    </div>
  //   let data1 =JSON.stringify(response.data) as any;
  //  data1[0].forEach((item,index)=>{
  //     console.log('items', item)
  //   })
        // var l = '<div v-for="(errorArray, idx) in notifmsg" :key="idx">'+
        //   '<div v-for="(allErrors, idx) in errorArray" :key="idx">'+
        // '<span class="text-danger">{{ allErrors}} </span>'+'
        // </div>'+'
        //  </div>';

        setTimeout(() => {
          Swal.fire({
            text:JSON.stringify(response.data),
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: translate('okgotit'),
            heightAuto: false,
            customClass: {
              confirmButton: "btn btn-primary",
            },
          }).then(() => {
            //  resetForm();
            // router.push({ name: "usersupdate" });
          });
        }, 2000);
      })
      // .catch(({ response }) => {
      //   if(response.data.success === false){
      //     setError(response.data.message);
      //   }else if(response.status =='422'){
      //     setError(response.data.password);
      //   }
      //   // setError(response.data.errors);
      // });
      setTimeout(() => {
          submitButton1.value?.removeAttribute("data-kt-indicator");
        }, 2000);
      }
  
      }
     
      const search = ref<string>("");
      
  
      return {
        submitButton1,
        saveChanges1,
        newclient,
        compainies,
        categories,
        roles,
        units,
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