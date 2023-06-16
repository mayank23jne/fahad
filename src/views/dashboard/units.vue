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
            <!-- <div class="row mb-6"> -->
              <!--begin::Label-->
              <!-- <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{ translate('hajj') }}</label
              > -->
              <!-- <div class="col-lg-8"> -->
                <!--begin::Row-->
                
                    <!-- <Field
                      type="text"
                      name="unit_number"
                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                      :placeholder="translate('unitno')"
                      v-model="newclient.unit_number"
                     
                    />
                    <div class="fv-plugins-message-container">
                      <div class="fv-help-block">
                        <ErrorMessage name="unit_number" />
                      </div>
                    </div> -->
              
               
              <!-- </div> -->
              <!--end::Col-->
            <!-- </div> -->
            <!--end::Input group-->
  
            <!--begin::Input group-->
            <!-- <div class="row mb-6"> -->
              <!--begin::Label-->
              <!-- <label class="col-lg-4 col-form-label required fw-semobold fs-6" -->
              <!-- >{{ translate('nationality') }}</label -->
              <!-- > -->
              <!--end::Label-->
  
              <!--begin::Col-->
              <!-- <div class="col-lg-8 fv-row">
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
              </div> -->
              <!--end::Col-->
            <!-- </div> -->
            <!--end::Input group-->
  
            <!--begin::Input group-->
            <!-- <div class="row mb-6"> -->
              <!--begin::Label-->
              <!-- <label class="col-lg-4 col-form-label  fw-semobold fs-6">
                <span class="required">{{ translate('noofpilgrims') }} </span>
              </label>
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="pilgrims"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('noofpilgrims')"
                  v-model="newclient.pilgrims" 
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="pilgrims" />
                  </div>
                </div>
              </div> -->
             
              <!--end::Col-->
            <!-- </div> -->
            <!--end::Input group-->
  
            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
                >{{translate('buildingno')}}</label
              >
              <!--end::Label-->
   
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="building_number"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('buildingno')"
                  v-model="newclient.building_number"  
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="building_number" />
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
                >{{translate('buildingname')}}</label
              >
              <!--end::Label-->
   
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="building_name"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('buildingname')"
                  v-model="newclient.building_name"  
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="building_name" />
                  </div>
                </div>
              </div>
              
              <!--end::Col-->
            </div>
            <!--end::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label fw-semobold fs-6">
                <span class="required">{{ translate('buidling_owner') }}</span>
              </label>
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  as="select"
                  name="client_id"
                  class="form-select form-select-solid form-select-lg fw-semobold"
                  :options="clientname"
                v-model="newclient.client_id"
                  
                >
                <template v-for="client in clientname" :key="client.id">
                  <option :value="client.id">{{ client.fullName }}</option>
                </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="client_id" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>

             <!--begin::Input group-->
             <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label  fw-semobold fs-6"
              >{{ translate('representative') }}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="representative"
                  class="form-control form-control-lg   form-control-solid"
                  :placeholder="translate('representative')"
                  v-model="newclient.representative"
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="representative" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
              <!--begin::Input group-->
              <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label  fw-semobold fs-6"
              >{{ translate('permitno') }}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="permissions"
                  class="form-control form-control-lg   form-control-solid"
                  :placeholder="translate('permitno')"
                  v-model="newclient.permissions"
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="permissions" />
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
                <span class="">{{ translate('selectcontractor') }}</span>
              </label>
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  as="select"
                  name="company"
                  class="form-select form-select-solid form-select-lg fw-semobold"
                  v-model="newclient.company"
                :options="compaines"
                >
                <template v-for="company in compaines" :key="company.id">
                <option :value="company.id">{{ company.company_name }}</option>
              </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="company" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
             <div class="row mb-6">
              
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{ translate('typeunits') }}</label
              >
  
              <div class="col-lg-8 fv-row">
               
                <Field
                  as="select"
                  name="type"
                  class="form-select form-select-solid form-select-lg"
                  v-model="newclient.unitType_id"
                    :options="units"
                >
                <template v-for="unit in units" :key="unit.id">
                  <option :value="unit.id" v-if="lang == 'en' || lang == 'enrtl'">{{ unit.type_en }}</option>
                  <option :value="unit.id" v-else>{{ unit.type }}</option>
                  <!-- <option :value="unit.id">{{ unit.type }}</option> -->
                </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="type" />
                  </div>
                </div>
              </div>
              
            </div> 
            <div class="row mb-6">
           
              <label class="col-lg-4 col-form-label fw-semobold fs-6"
               >{{ translate('uploadfile') }}</label>
              <div class="col-lg-8 fv-row">
                <Field
                type="file"
                name="image"
                accept="image/*"
                    ref="file"
                class="form-control form-control-lg form-control-solid"
                placeholder="image"
                v-model="newclient.image"
              />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="image" />
                  </div>
                </div>
              </div>
            
            </div>
            <!--             
            <div class="col-lg-12 col-sm-12 col-md-12 text-center mb-5">
                  <img
                    v-if="newclient.image == ''"
                
                    src="https://www.w3schools.com/images/lamp.jpg"
                    @click="onImageClick(data.item.image)"
                  />
                  <img
                    v-else
                    :src="
                      'https://forms.innovativeideasbox.com/API/public/uploads/' +
                      newclient.image
                    "
                    :class="getImageClass(data.index)"
                    @click="
                      onImageClick(
                        'https://forms.innovativeideasbox.com/API/public/uploads/' +
                          newclient.image
                      )
                    "
                  />
                </div> -->
          </div>
          <!--end::Card body-->
  
          <!--begin::Actions-->
          <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button
              type="reset"
              class="btn btn-light btn-active-light-primary me-2"
            >
              {{translate("cancel")}}
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
       id:number;
        unit_id:string;
        // unit_number:string;
        // nationality:string;
        // pilgrims: "",
        building_number:string;
        building_name:string;
        representative:string;
        permissions: string;
        client_id:string;
        unitType_id:string;
        image: string;
        company:string;
   }

   interface units{
  id:number | any;
  type:string | any;
}

   interface clientname{
  id:number | any;
  fullName:string | any;
}

interface compaines{
  id:number | any;
  company_name:string | any;
}

 
  export default defineComponent({
    name: "units",
   props:['id'],
    components: {
      ErrorMessage,
      Field,
      VForm,
    },
  
    setup(props) {
      const { t, te } = useI18n();
    const submitButton1 = ref<HTMLElement | null>(null);
       const newclient=ref<newclient>({
        id: 0,
        unit_id: "",
        // unit_number:"",
        // nationality: "",
        // pilgrims: "",
        building_number: "",
        building_name:"",
        representative:"",
        permissions: "",
        client_id: "",
        unitType_id: "",
        image: "",
        company: "",
      });
      const lang = localStorage.getItem('lang');
      const clientname=ref<clientname>({
      id:0,
      fullName:"",
     });
     const units=ref<units>();
     const compaines=ref<compaines>();

       
        
         const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

         const profileDetailsValidator = Yup.object().shape({
          // unit_number: Yup.string().required(translate('unitreq')),
          // nationality: Yup.string().required(translate('nationalityreq')),
          // pilgrims: Yup.string().required(translate('pilgrimsreq')),
          building_number: Yup.string().required(translate('buildingreq')),
          building_name: Yup.string().required(translate('buildingnamereq')),
        //  representative: Yup.string().required(translate('representreq')),
          client_id: Yup.string().required(translate('clientreq')),
        //  permissions: Yup.string().required(translate('permissionreq')),
          // company: Yup.string().required(translate('companyreq')),
          type: Yup.string().required(translate('typereq')),
    });


   


      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
        ApiService.get("showUnitTypes")
    .then(({ data }) => {
      units.value = data;
    });


        ApiService.get("showCompanies")
    .then(({ data }) => {
      compaines.value = data.data;
       
    });

        ApiService.get("showClients")
    .then(({ data }) => {
      clientname.value = data.data.map((client) => {
        return {
          fullName: `${client.firstname} ${client.lastname}`,
          id: client.id,
        };
      });
    });
    if(props.id){
    ApiService.get(`ShowUnitDetail/${props.id}`)
    .then(({ data }) => {
      newclient.value = data;
       
    });}
     
      });
    
      const saveChanges1 = () => {
      if (submitButton1.value) {
        submitButton1.value.setAttribute("data-kt-indicator", "on");

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
      if(props.id){
        data.append("id",props.id);
      }
      // data.append("unit_id", newclient.value.unit_number);
      // data.append("nationnality", newclient.value.nationality);
      // data.append("pilgrims", newclient.value.pilgrims);
      data.append("bulding_number", newclient.value.building_number);
      data.append("bulding_name", newclient.value.building_name);
      data.append("representative", newclient.value.representative);
      data.append("declaration", newclient.value.permissions);
      data.append("client_id", newclient.value.client_id === null ? "" : newclient.value.client_id);
      data.append("unitType_id", newclient.value.unitType_id);
      data.append("image", newclient.value.image=== null ? "" : newclient.value.image);
      data.append("company", newclient.value.company);

      ApiService.post("createUnit", data)
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
          resetForm();
          router.push({ name: "unitsupdate" });
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
        newclient,
        units,
        clientname,
        compaines,
         formSubmit,
         profileDetailsValidator,
         translate,
         lang
      
      };
    },
  });
  </script>
  <style>
.fv-help-block{
  color: #d72626;
}
</style>