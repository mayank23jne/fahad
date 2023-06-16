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
              >{{translate('selectpropertytype')}}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
               
               <Field
                 as="select"
                 name="unittype"
                 class="form-select form-select-solid form-select-lg"
                 v-model="newItem.unittype"
                   :options="units"
                   @change="onChangeSelect"
               >
               <template v-for="unit in units" :key="unit.id">
                 <option :value="unit.id" >{{ unit.building_number }}</option>
               </template>
               </Field>
               <div class="fv-plugins-message-container">
                 <div class="fv-help-block">
                   <ErrorMessage name="unittype" />
                 </div>
               </div>
             </div>
              <!--end::Col-->
            </div>
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{translate('buildingname')}}</label
              >
              <div class="col-lg-8">
                <!--begin::Row-->
                
                    <Field
                      type="text"
                      name="buildingname"
                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                      :placeholder="translate('buildingname')"
                      v-model="newItem.building_name"
                     
                    />
                    <div class="fv-plugins-message-container">
                      <div class="fv-help-block">
                        <ErrorMessage name="buildingname" />
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
              >{{translate('owner')}}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="owner"
                  class="form-control form-control-lg   form-control-solid"
                  :placeholder="translate('owner')"
                  v-model="newItem.owner"
                
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="owner" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{translate('representative')}}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  type="text"
                  name="representative"
                  class="form-control form-control-lg   form-control-solid"
                  :placeholder="translate('representative')"
                  v-model="newItem.representative"
                
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="representative" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{translate('licenseno')}}</label
              >
              <div class="col-lg-8">
                <!--begin::Row-->
                
                    <Field
                      type="text"
                      name="permitno"
                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                      :placeholder="translate('permitno')"
                      v-model="newItem.permitno"
                     
                    />
                    <div class="fv-plugins-message-container">
                      <div class="fv-help-block">
                        <ErrorMessage name="permitno" />
                      </div>
                    </div>
              
               
              </div>
              <!--end::Col-->
            </div>
           
            <div class=" text-right mb-2">
                  <button
                  type="button"
                  class="btn btn-sm btn-flex btn-light-primary"
                  @click="add"
                >
                  <span class="svg-icon svg-icon-3">
                    <inline-svg src="/media/icons/duotune/general/gen035.svg" />
                  </span>
                  {{translate("addfields")}}
                </button>
                </div>
                <div v-for="(a,index) in newItem.fields" :key="index">
                  
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{translate('list')}}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                :id="`list${index}`"
                  type="text"
                  :name="`list${index}`"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('list')"
                  v-model="a.property_list"
                
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="list" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{translate('noofpeople')}}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <Field
                  :id="`noofpeople${index}`"
                  type="text"
                  :name="`noofpeople${index}`"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('noofpeople')"
                  v-model="a.no_of_people"
                
                />
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="noofpeople" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <span class="badge badge-pill mb-5"  @click="deletefields(a.id,index)"><i class="fa fa-trash me-1  fs-5"></i></span>
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

interface fields{
         id:number;
         property_list:string;
         no_of_people:string;
  }

interface newItem{
        building_number:string;
        building_name:string;
        owner:string;
        client_id:string;
        unittype:string;
        permitno:string;
        representative:string;
       
        fields:fields[],
  }
 
  interface property_type{
      name_ar: string | any;
      name_en : string | any;
      id:number | any;
   }

   interface clientname{
    id:number | any;
    fullName:string | any;
    }


  export default defineComponent({
    name: "editindustrytype",
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
      const property_type = ref<Array<property_type>>([]);
        const units = ref<any>([]);
        const client = ref<any>([]);
    const newItem = ref<newItem>({ 
      building_number:'',
      building_name:'',
        owner:'',
        client_id:'',
        unittype:'',
        permitno:'',
        representative:'',
        fields:[],
        // list:'',
        // noofpeople:'',
    });
     const lang = localStorage.getItem('lang');
         const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

    const clientname=ref<clientname>({
      id:0,
      fullName:"",
     });

    const add = ()=>
     {
      newItem.value.fields.push({
        "id":newItem.value.fields.length+1,
        "property_list": "",
        "no_of_people":''
      })
    } 

    const deletefields = (value,e)=> {
   
      newItem.value.fields.splice(e,1)
    }

         const profileDetailsValidator = Yup.object().shape({
          unittype: Yup.string().required(translate('reqselectproperty')),
         // propertyname_en: Yup.string().required(translate('name_en_req')),
          // owner_en: Yup.string().required(translate('ownerreq_en')),
         // owner: Yup.string().required(translate('owner_req')),
          permitno: Yup.string().required(translate('permitnoreq')),
        
    });


   


      onMounted(() => {
       
        ApiService.post("showRegisteredPropertyId",{id:props.id, user_id:user_id})
    .then(({ data }) => {
        newItem.value.unittype = data[0].unitid;
        newItem.value.building_number = data[0].building_no;
        newItem.value.building_name=data[0].building_name;
        newItem.value.owner=data[0].owner;
        newItem.value.client_id=data[0].client_id;
        newItem.value.permitno= data[0].permitno;
        newItem.value.representative= data[0].representative;
    });
    
    ApiService.post("showRegisteredFieldbyProperty",{id:props.id, user_id:user_id})
    .then(({ data }) => {
       
        newItem.value.fields = data;
        
    });

    ApiService.get('showUnits')
        .then(({ data }) => {
          units.value = data.data;
        })
        .catch(({ response }) => {
        });

    ApiService.post('showPropertyType', {user_id:user_id})
        .then(({ data }) => {
          property_type.value = data;
        })
        .catch(({ response }) => {
        });

        ApiService.get("showClients")
    .then(({ data }) => {
      console.log('sjow', data.data);
      clientname.value = data.data.map((client) => {
        return {
          fullName: `${client.firstname} ${client.lastname}`,
          id: client.id,
        };
      });

      client.value.push(clientname.value);
    });

      });

      const onChangeSelect = (e)=>{
        units.value.map((item,index) => {
        if(item.id === Number(e.target.value)){
        newItem.value.building_number= item.building_number;
         newItem.value.building_name= item.building_name;
         newItem.value.client_id=item.client_id;
         newItem.value.permitno= item.permissions;
         newItem.value.representative= item.representative;
         client.value[0].map((client,index) => {
           if(client.id === Number(item.client_id) ){
            console.log('fullname',client.fullName)
            newItem.value.owner= client.fullName;
           }
         });
        }
      });
    }
    
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

        ApiService.post("updateRegisteredProperty", {
                building_number: newItem.value.building_number,
                unittype:newItem.value.unittype,
                building_name:newItem.value.building_name,
                client_id:newItem.value.client_id,
                owner:newItem.value.owner,
                permitno:newItem.value.permitno,
                representative:newItem.value.representative,  
                fields:newItem.value.fields,
                user_id:user_id,
                id:props.id,
        })
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
          router.push({ name: "registeredproperty" });
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
         property_type,
         lang,
         add,
         deletefields,
         onChangeSelect,
         units
      };
    },
  });
  </script>
  <style>
.fv-help-block{
  color: #d72626;
}
</style>