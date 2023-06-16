<template>
  <!--begin::Basic info-->
  <div class="card mb-5 mb-xl-10">
    <div id="kt_account_profile_details" class="collapse show">
      <!--begin::Form-->
      <VForm
        id="kt_account_profile_details_form"
        class="form"
        novalidate
        @submit="saveChanges1()"
        :validation-schema="profileDetailsValidator"
      >
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
            >{{ translate('hajj') }}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
              <!--begin::Row-->
              <div class="row">
                <!--begin::Col-->
              
                  <Field
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
                  </div>
               
                <!--end::Col-->
              </div>
              <!--end::Row-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->

          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
            >{{ translate('nationality') }}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
                type="text"
                name="nationality"
                class="form-control form-control-lg form-control-solid"
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
            <label class="col-lg-4 col-form-label required fw-semobold fs-6">
              <span class="required">{{ translate('noofpilgrims') }}</span>
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
                type="text"
                name="pilgrims"
                class="form-control form-control-lg form-control-solid"
                :placeholder="translate('noofpilgrims')"
                v-model="newclient.pilgrims"
              />
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="pilgrims" />
                </div>
              </div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->

          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-semobold fs-6"
            >{{translate('buildingno')}} </label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
                type="text"
                name="building_number"
                class="form-control form-control-lg form-control-solid"
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
            <label class="col-lg-4 col-form-label fw-semobold fs-6">
              <span class="required">{{ translate('buidling_owner') }} </span>

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
          <!--end::Input group-->

          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
            >{{ translate('permitno') }}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <!--begin::Input-->
              <Field
                type="text"
                name="permissions"
                class="form-control form-control-lg form-control-solid"
                :placeholder="translate('permission')"
                v-model="newclient.permissions"
              />
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="permissions" />
                </div>
              </div>
              <!--end::Input-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->

          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
            >{{ translate('selectcontractor') }}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
                as="select"
                name="company"
                class="form-select form-select-solid form-select-lg"
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
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{ translate('typeunits') }} </label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
                as="select"
                name="type"
                class="form-select form-select-solid form-select-lg"
                v-model="newclient.unitType_id"
                    :options="units"
              >
              <template v-for="unit in units" :key="unit.id">
                <option :value="unit.id">{{ unit.type }}</option>
              </template>
              </Field>
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="type" />
                </div>
              </div>
            </div>
            <!--end::Col-->
          </div>
          <div class="row mb-6">
          <label class="col-lg-4 col-form-label fw-semobold fs-6"
          >{{ translate('uploadfile') }}</label
            >
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

        
        <div class="card-footer d-flex justify-content-end py-6 px-9">
          <button
            type="reset"
            class="btn btn-light btn-active-light-primary me-2"
          >
            {{translate('cancel')}}
          </button>

          <button
            type="submit"
            id="kt_account_profile_details_submit"
            ref="submitButton1"
            class="btn btn-primary"
          >
            <span class="indicator-label"> {{translate('save')}}</span>
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
import { useI18n } from "vue-i18n";


interface newclient{
       id:number;
        unit_id:string;
        unit_number:string;
        nationality:string;
        pilgrims: "",
        building_number:string;
        permissions: string;
        client_id:string;
        unitType_id:string;
        image: string;
        company:string;
}
interface clientname{
  id:number | any;
  fullName:string | any;
}

interface units{
  id:number | any;
  type:string | any;
}

interface compaines{
  id:number | any;
  company_name:string | any;
}

export default defineComponent({
  name: "unites",
  props:['id'],
  components: {
    ErrorMessage,
    Field,
    VForm,
  },

  setup(props) {
    const { t, te } = useI18n();
  const submitButton1 = ref<HTMLElement | null>(null);
   const compaines=ref<compaines>();
      const unitinf= ref({});
     const clientname=ref<clientname>({
      id:0,
      fullName:"",
     });
     const units=ref<units>();
     const newclient=ref<newclient>({
        id: 0,
        unit_id: "",
        unit_number:"",
        nationality: "",
        pilgrims: "",
        building_number: "",
        permissions: "",
        client_id: "",
        unitType_id: "",
        image: "",
        company: "",
      });
  
      const profileDetailsValidator = Yup.object().shape({
          unit_number:Yup.string().required().label("unit_number"),
          // nationality: Yup.string().required().label("nationality"),
          // pilgrims: Yup.string().required().label("pilgrims"),
          // building_number: Yup.string().required().label("building_number"),
          // client_id: Yup.string().required().label("client_id"),
          // permissions: Yup.string().required().label("permissions"),
          // company: Yup.string().required().label("company"),
          //  type: Yup.string().required().label("type"),
    });

    const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };
      
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
      console.log('data', data.data);
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
      console.log('ShowUnitDetail', data);
      newclient.value = data;
       
    });}
   
    });

    const saveChanges1 = () => {
      if (submitButton1.value) {
        console.log('submit1');
        submitButton1.value.setAttribute("data-kt-indicator", "on");

        setTimeout(() => {
          submitButton1.value?.removeAttribute("data-kt-indicator");
        }, 2000);
      }
    }

    const formSubmit=()=> {
      console.log('formsubmit');
      const data = new FormData();
      
      data.append("unit_id", newclient.value.unit_number);
      data.append("nationnality", newclient.value.nationality);
      data.append("pilgrims", newclient.value.pilgrims);
      data.append("bulding_number", newclient.value.building_number);
      data.append("declaration", newclient.value.permissions);
      data.append("client_id", newclient.value.client_id === null ? "" : newclient.value.client_id);
      data.append("unitType_id", newclient.value.unitType_id);
      data.append("image", newclient.value.image=== null ? "" : newclient.value.image);
      data.append("company", newclient.value.company);

      // console.log("unit_id", newclient.value.unit_number,"nationnality", newclient.value.nationality,
      // "pilgrims", newclient.value.pilgrims,"bulding_number", newclient.value.building_number,"declaration", newclient.value.permissions
      // ,"client_id", newclient.value.client_id,"unitType_id", newclient.value.unitType_id,"image", newclient.value.image,
      // "company", newclient.value.company )

      ApiService.post("createUnit", data)
    .then(({ data }) => {
      
        newclient.value.unit_id = "";
        newclient.value.nationality = "";
        newclient.value.pilgrims = "";
        newclient.value.building_number = "";
        newclient.value.permissions = "";
        newclient.value.client_id = "";
        newclient.value.unitType_id = "";
        newclient.value.image = "";
        newclient.value.company = "";

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
          router.push({ name: "unitsupdate" });
        });
      }, 2000);
      
    });
   

    }
   
    const search = ref<string>("");
    

    return {
      newclient,
      clientname,
      compaines,
      units,
      saveChanges1,
      formSubmit,
      profileDetailsValidator,
      translate
    };
  },
});
</script>
