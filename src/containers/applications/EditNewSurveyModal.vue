<template>
    <div
      class="modal fade"
      id="kt_modal_newedit_survey"
      ref="neweditSurveyModalRef"
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
            <h2 class="fw-bold">{{translate('editsurvey')}}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_newedit_survey_close"
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
          <VForm
          id="kt_account_profile_details_form"
        class="form"
        novalidate
      
        @submit="submit()"
        :validation-schema="profileDetailsValidator"
         
        >
          <!--begin::Card body-->
          <div class="modal-body py-10 px-lg-17">
              <!--begin::Scroll-->
              <div
                class="scroll-y me-n7 pe-7"
                id="kt_modal_edit_survey_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_edit_survey_header"
                data-kt-scroll-wrappers="#kt_modal_edit_survey_scroll"
                data-kt-scroll-offset="300px"
              >
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-form-label required fw-semobold fs-6"
              >{{ translate('title') }}</label
              >
              <div class="">
                <!--begin::Row-->
                
                    <Field
                      type="text"
                      name="title"
                      class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                      :placeholder="translate('title')"
                      v-model="newItem.title"
                      style="background-color:#f5f8fa0f; border-color: #e3e3e3;"
                    />
                    <div class="fv-plugins-message-container">
                      <div class="fv-help-block">
                        <ErrorMessage name="title" />
                      </div>
                    </div>
              
               
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
  
            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class=" col-form-label required fw-semobold fs-6"
              >{{ translate('detail') }}</label
              >
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class=" fv-row">
                <Field
                type="text"
                  rows="3"
                  name="detail"
                  class="form-control form-control-lg required  form-control-solid"
                  :placeholder="translate('detail')"
                  v-model="newItem.detail"
                  style="background-color:#f5f8fa0f; border-color: #e3e3e3;"
                >
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="detail" />
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
  
       
  
            <!-- <div class="row mb-6"> -->
              <!--begin::Label-->
              <!-- <label class="col-form-label fw-semobold fs-6">
                <span class="required">{{ translate('cat') }}</span>
              </label> -->
              <!--end::Label-->
  
              <!--begin::Col-->
              <!-- <div class="fv-row">
                <Field
                  as="select"
                  name="category"
                  class="form-select form-select-solid form-select-lg fw-semobold"
                  v-model="newItem.category" :options="categories"
                  style="background-color:#f5f8fa0f; border-color: #e3e3e3;"
                >
              
                    <template v-for="category in categories" :key="category">
                        <option :value="category.value">{{ category.label }}</option>
                    </template>
               
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="category" />
                  </div>
                </div>
              </div> -->
              <!--end::Col-->
            <!-- </div> -->
             
            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-form-label fw-semobold fs-6">
                <span class="required">{{ translate('industrytype') }}</span>
              </label>
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class=" fv-row">
                <Field
                  as="select"
                  name="industrytype"
                  class="form-select form-select-solid form-select-lg fw-semobold"
                  v-model="newItem.industrytype" :options="industrytype"
                  style="background-color:#f5f8fa0f; border-color: #e3e3e3;"
                >
                <template v-for="industry in industrytype" :key="industry.id">
                        <option :value="industry.id" v-if="lang == 'en' || lang == 'enrtl' " :label="industry.name_en">{{ industry.name_en}}</option>
                        <option :value="industry.id" v-else :label="industry.name_ar">{{ industry.name_ar}}</option>
                    </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="industrytype" /> 
                  </div>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
             <div class="row mb-6">
              
              <label class=" col-form-label required fw-semobold fs-6"
              >{{ translate('inspectiontype') }}</label
              >
  
              <div class=" fv-row">
               
                <Field
                  as="select"
                  name="inspectiontype"
                  class="form-select form-select-solid form-select-lg"
                  v-model="newItem.inspectiontype" :options="inspectiontype.name_en"
                  style="background-color:#f5f8fa0f; border-color: #e3e3e3;"
                >
                <template v-for="ins in inspectiontype" :key="ins">
                        <option :value="ins.id" v-if="lang == 'en' || lang == 'enrtl'" :label="ins.name_en">{{ ins.name_en}}</option>
                        <option :value="ins.id" v-else :label="ins.name_ar">{{ ins.name_ar}}</option>
                    </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="inspectiontype" />
                  </div>
                </div>
              </div>
              
            </div> 
            <!--dgfdg-->
            <!--begin::Input group-->
            <div class="row mb-6">
              
              <label class="col-form-label required fw-semobold fs-6"
              >{{ translate('inspectionpropertytype') }}</label
              >
  
              <div class=" fv-row">
               
                <Field
                  as="select"
                  name="inspectionproperty"
                  class="form-select form-select-solid form-select-lg"
                  v-model="newItem.inspectionproperty" :options="inspectionproperty"
                  style="background-color:#f5f8fa0f; border-color: #e3e3e3;"
                >
                <template v-for="inspection in inspectionproperty" :key="inspection">
                        <option :value="inspection.id" v-if="lang == 'en' || lang == 'enrtl'"  :label="inspection.propertyname_en">{{ inspection.propertyname_en}}</option>
                        <option :value="inspection.id" v-else :label="inspection.propertyname_ar">{{ inspection.propertyname_ar}}</option>
                    </template>
                </Field>
                <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="inspectionproperty" />
                  </div>
                </div>
              </div>
              
            </div> 
            <!--dgfdg-->
            <!--begin::Input group-->
            <div class="row mb-6">
              
              <label class="col-form-label fw-semobold fs-6"
              >{{ translate('registeredproperties') }}</label
              >
  
              <div class=" fv-row">
               
                <Field
                  as="select"
                  name="registeredproperty"
                  class="form-select form-select-solid form-select-lg"
                  v-model="newItem.registeredproperty" :options="registeredproperty.propertyname_en"
                  style="background-color:#f5f8fa0f; border-color: #e3e3e3;"
                  @change="onRegisteredChange"
                >
                <template v-for="register in registeredproperty" :key="register">
                        <option :value="register.id" :label="register.building_no">{{ register.building_no}}</option>
                        <!-- <option :value="register.id" v-else :label="register.propertyname_ar">{{ register.propertyname_ar}}</option> -->
                    </template>
                </Field>
                <!-- <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="registeredproperty" />
                  </div>
                </div> -->
              </div>
              
            </div> 
             <!--begin::Input group-->
             <div class="row mb-6">
              
              <label class="col-form-label fw-semobold fs-6"
              >{{ translate('offices') }}</label
              > 
              <div class=" fv-row">
               
                <Field
                  as="select"
                  name="officefield"
                  class="form-select form-select-solid form-select-lg"
                  v-model="newItem.officefield" :options="officelistnew"
                  style="background-color:#f5f8fa0f; border-color: #e3e3e3;"
                >
               
                <template v-for="office in officelistnew" :key="office">
                  
                        <option :value="office.id" :label="office.property_list">{{ office.property_list}}</option>
                        <!-- <option :value="register.id" v-else :label="register.propertyname_ar">{{ register.propertyname_ar}}</option> -->
                    </template>
                </Field>
                <!-- <div class="fv-plugins-message-container">
                  <div class="fv-help-block">
                    <ErrorMessage name="officefield" />
                  </div>
                </div> -->
              </div>
              
            </div> 
            <!--dgfdg-->
          </div>
          </div>

        
  
      
            <div class="modal-footer flex-center">
              <!--begin::Button-->
              <button
              type="reset"
              class="btn btn-light btn-active-light-primary me-2"
            >
              {{translate("discard")}}
            </button>
            <button
            type="submit"
            id="kt_account_profile_details_submit"
            ref="formRef"
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
        </VForm>
            <!--end::Modal footer-->
         <!--
            
             </el-form> -->
          <!--end::Form-->
        </div>
      </div>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent, onMounted, ref, toRefs } from "vue";
  import { ErrorMessage, Field, Form as VForm } from "vee-validate";
  import { hideModal } from "@/core/helpers/dom";
  import Swal from "sweetalert2";
import ApiService from "@/core/services/ApiService";
import router from "@/router";
import { translate } from "element-plus";
import { useI18n } from "vue-i18n";
import * as Yup from "yup";


   
  interface newItem{
        title:string;
        category:string;
        detail:string;
        status:string;  
        industrytype:string;
        inspectiontype:string;
        inspectionproperty:string;
        registeredproperty:string;
        officefield:string,
  }


  export default defineComponent({
    name: "edit-new-survey-modal",
    components: {
        ErrorMessage,
      Field,
      VForm,
    },
    props:['categories','id','currentSurvey', 'statuses', 'surveydata', "industrytype", "inspectiontype", "inspectionproperty", "registeredproperty", "officelist"],
    emit:['update'],

    setup(props, {emit}) {
      const formRef = ref<null | HTMLFormElement>(null);
      const neweditSurveyModalRef = ref<null | HTMLElement>(null);
      const loading = ref<boolean>(false);
      const lang= localStorage.getItem('lang') as string;
      const successmessage=ref<boolean>(false);
        const submitButton1 = ref<HTMLElement | null>(null);
          const officelistnew= ref(props.officelist) ;
        const { t, te } = useI18n();
        const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };
    
      const newItem = ref<newItem>({ title: "", category: "", detail: "",  status: "", industrytype: "",
        inspectiontype: "",
        inspectionproperty: "",
        registeredproperty: "",
        officefield:"", });
        const profileDetailsValidator = Yup.object().shape({
          title: Yup.string().required(translate('reqtitle')),
          detail: Yup.string().required(translate('detailreq')),
          // category: Yup.string().required(translate('selectcategory')),
          industrytype: Yup.string().required(translate('selectindustrytype')),
          inspectiontype: Yup.string().required(translate('selectinspectiontype')),
          inspectionproperty: Yup.string().required(translate('selectinspectionproperty')),
          // registeredproperty: Yup.string().required(translate('selectregisteredproperty')),
          // officefield:Yup.string().required(translate('selectregisteredproperty')),
    });
    //   const rules = ref({
    //     title: [
    //       {
    //         required: true,
    //         message: translate('reqtitle'),
    //         trigger: "change",
    //       },
    //     ],
    //     detail: [
    //       {
    //         required: true,
    //         message: translate('detailreq'),
    //         trigger: "change",
    //       },
    //     ],
    //     category: [
    //       {
    //         required: true,
    //         message: translate('selectcategory'),
    //         trigger: "change",
    //       },
    //     ],
    //     industrytype:[
    //       {
    //         required: true,
    //         message: translate('selectmaster'),
    //         trigger: "change",
    //       },
    //     ],
    //     inspectiontype:[
    //       {
    //         required: true,
    //         message: translate('selectmaster'),
    //         trigger: "change",
    //       },
    //     ],
    //     inspectionproperty:[
    //       {
    //         required: true,
    //         message: translate('selectmaster'),
    //         trigger: "change",
    //       },
    //     ],
    //     registeredproperty:[
    //       {
    //         required: true,
    //         message: translate('selectmaster'),
    //         trigger: "change",
    //       },
    //     ],
    //   });

      onMounted(async() => {
        await ApiService.get(`show/${props.id}`)
      .then(({ data }) => {
        console.log('surveymodel', data);
        newItem.value = data;
        if(data){
        ApiService.post('showRegisteredFieldId',{id:data.registeredproperty})
        .then(({ data }) => {
         // console.log('sdfsgdata', data);
          if(data){
            officelistnew.value = data;
        }
        })
        .catch(({ response }) => {
          
        });}

      })
      
      });
  
      const onRegisteredChange = (e) =>{
       
        ApiService.post("showRegisteredFieldId", {
                id: e.target.value}) .then(({ data }) => 
            {
             
              officelistnew.value = data;
            
              
            })
      }
  

      const saveChanges1 = () => {
      if (formRef.value) {
        formRef.value.setAttribute("data-kt-indicator", "on");

        setTimeout(() => {
          formRef.value?.removeAttribute("data-kt-indicator");
        }, 2000);
      }
    };

      const submit = () => {
        if (!formRef.value) {
          return;
        }
             const array = [props.surveydata];
            // let a1="";
            if (formRef.value) {
          // if (valid) {
            const date = new Date();
            loading.value = true;
            ApiService.post("updateTemplate", {
              id:props.id,
                title: newItem.value.title,
            detail:newItem.value.detail,
            user_id :localStorage.getItem('logged_user_id'),
            // category: newItem.value.category,
            industrytype: newItem.value.industrytype,
            inspectiontype: newItem.value.inspectiontype,
            inspectionproperty: newItem.value.inspectionproperty,
            registeredproperty: newItem.value.registeredproperty,
            officefield:newItem.value.officefield,
            date:
              date.getDay() + "." + date.getMonth() + 1 + "." + date.getFullYear(),
            questions: []})
        .then(({ data }) => 
            {
              props.currentSurvey.value = newItem.value;
                          
      setTimeout(() => {
              loading.value = false;
             
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
                 hideModal(neweditSurveyModalRef.value);
                // router.push({name:"survey-details", params:{id:data}})
              });
            }, 2000);  

             })
           
            // }
        }
      };
  
      return {
        newItem,
        // rules,
        profileDetailsValidator,
        submit,
        formRef,
        loading,
        neweditSurveyModalRef,
        translate,
        // saveChanges1,
        officelistnew,
        lang,
        onRegisteredChange
      };
    },
  });
  </script>
   <style>
   .fv-help-block{
     color: #d72626;
   }
   </style>
  