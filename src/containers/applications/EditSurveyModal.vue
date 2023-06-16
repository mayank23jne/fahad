<template>
    <div
      class="modal fade"
      id="kt_modal_edit_survey"
      ref="editSurveyModalRef"
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
              id="kt_modal_edit_survey_close"
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
            @submit.prevent="submit()"
            :model="newItem"
            :rules="rules"
            ref="formRef"
          >
            <!--begin::Modal body-->
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
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="required fs-6 fw-semobold mb-2">{{translate('title')}}</label>
                  <el-form-item prop="title">
                    <el-input
                      v-model="newItem.title"
                      type="text"
                      name="title"
                      placeholder=""
                    />
                  </el-form-item>
                </div>
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="required fs-6 fw-semobold mb-2">{{translate('detail')}}</label>
                  <el-form-item prop="detail">
                <el-input
                  v-model="newItem.detail"
                  type="textarea"
                  rows="3"
                  name="detail"
                  placeholder="Type Target Details"
                />
              </el-form-item>
                </div>
                <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('cat')}}</span>
                    </label>
                   
                    <el-form-item prop="category">
                    <!--begin::Input-->
                    <el-select v-model="newItem.category" :options="categories" >
                      <template v-for="category in categories" :key="category">
                        <el-option :value="category.value">{{ category.label }}</el-option>
                    </template>
                    </el-select>
                    </el-form-item>
                    <!--end::Input-->
                  </div>

                  <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('industrytype')}}</span>
                    </label>
                   
                    <el-form-item prop="industrytype">
                    <!--begin::Input-->
                    
                    <el-select :popper-append-to-body="false"
            :teleported="false"
            v-model="newItem.industrytype" :options="industrytype"
            name="industrytype"
              as="select"
 ><el-option
 v-for="(industry, index) in industrytype" :key="industry.id"
        :value="index" 
        :label="industry.name_en"
      >
      {{industry.name_en}}
    </el-option>
                      <!-- <template v-for="industry in industrytype" :key="industry.id">
                        <el-option :label="industry.name_en" :value="industry.id"   v-if="lang == 'en' || lang == 'enrtl'  " >{{ industry.name_en}}</el-option>
                        <el-option :value="industry.id"  :label="industry.name_ar" v-else >{{ industry.name_ar}}</el-option>
                    </template> -->
                    </el-select>
                    </el-form-item>
                    <!--end::Input-->
                  </div>
                  <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('inspectiontype')}}</span>
                    </label>
                   
                    <el-form-item prop="inspectiontype">
                    <!--begin::Input-->
                    <el-select v-model="newItem.inspectiontype" :options="inspectiontype.name_en" >
                      <template v-for="ins in inspectiontype" :key="ins">
                        <el-option :value="ins.id" v-if="lang == 'en' || lang == 'enrtl'" :label="ins.name_en">{{ ins.name_en}}</el-option>
                        <el-option :value="ins.id" v-else :label="ins.name_ar">{{ ins.name_ar}}</el-option>
                    </template>
                    </el-select>
                    </el-form-item>
                    <!--end::Input-->
                  </div>
                  <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('inspectionpropertytype')}}</span>
                    </label>
                   
                    <el-form-item prop="inspectionproperty">
                    <!--begin::Input-->
                    <el-select v-model="newItem.inspectionproperty" :options="inspectionproperty"  value-key="id">
                      <template v-for="inspection in inspectionproperty" :key="inspection">
                        <el-option :value="inspection.id" v-if="lang == 'en' || lang == 'enrtl'"  :label="inspection.propertyname_en">{{ inspection.propertyname_en}}</el-option>
                        <el-option :value="inspection.id" v-else :label="inspection.propertyname_ar">{{ inspection.propertyname_ar}}</el-option>
                    </template>
                    </el-select>
                    </el-form-item>
                    <!--end::Input-->
                  </div>
                  <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('registeredproperty')}}</span>
                    </label>
                   
                    <el-form-item prop="registeredproperty">
                    <!--begin::Input-->
                    <el-select v-model="newItem.registeredproperty" :options="registeredproperty.propertyname_en" >
                      <template v-for="register in registeredproperty" :key="register">
                        <el-option :value="register.id" v-if="lang == 'en' || lang == 'enrtl'" :label="register.propertyname_en">{{ register.propertyname_en}}</el-option>
                        <el-option :value="register.id" v-else :label="register.propertyname_ar">{{ register.propertyname_ar}}</el-option>
                    </template>
                    </el-select>
                    </el-form-item>
                    <!--end::Input-->
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
                id="kt_modal_edit_survey_cancel"
                class="btn btn-light me-3"
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
import { translate } from "element-plus";
import { useI18n } from "vue-i18n";



   
  interface newItem{
        title:string;
        category:string;
        detail:string;
        status:string;  
        industrytype:string;
        inspectiontype:string;
        inspectionproperty:string;
        registeredproperty:string;
  }


  export default defineComponent({
    name: "add-survey-modal",
    components: {},
    props:['categories','id','currentSurvey', 'statuses', 'surveydata', "industrytype", "inspectiontype", "inspectionproperty", "registeredproperty"],
    emit:['update'],

    setup(props, {emit}) {
      const formRef = ref<null | HTMLFormElement>(null);
      const editSurveyModalRef = ref<null | HTMLElement>(null);
      const loading = ref<boolean>(false);
      const lang= localStorage.getItem('lang') as string;
      const successmessage=ref<boolean>(false);
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
        registeredproperty: "" });
      const rules = ref({
        title: [
          {
            required: true,
            message: translate('reqtitle'),
            trigger: "change",
          },
        ],
        detail: [
          {
            required: true,
            message: translate('detailreq'),
            trigger: "change",
          },
        ],
        category: [
          {
            required: true,
            message: translate('selectcategory'),
            trigger: "change",
          },
        ],
        industrytype:[
          {
            required: true,
            message: translate('selectmaster'),
            trigger: "change",
          },
        ],
        inspectiontype:[
          {
            required: true,
            message: translate('selectmaster'),
            trigger: "change",
          },
        ],
        inspectionproperty:[
          {
            required: true,
            message: translate('selectmaster'),
            trigger: "change",
          },
        ],
        registeredproperty:[
          {
            required: true,
            message: translate('selectmaster'),
            trigger: "change",
          },
        ],
      });

      onMounted(async() => {
        await ApiService.get(`show/${props.id}`)
      .then(({ data }) => {
        newItem.value = data;
        // if(data.industrytype){
        //   for (let i = 0; i < props.industrytype.length; i++) {
        //   if (props.industrytype[i].id === data.industrytype) {
        //     if(lang == 'en' || lang == 'enrtl'){
        //     newItem.value.inspectionproperty = props.industrytype[i].name_en;}else{
        //       newItem.value.inspectionproperty = props.industrytype[i].name_ar;
        //     }
        //   }
        // }
        // }
      })
        // newItem.value = await props.currentSurvey;
      });
  
      const submit = () => {
        if (!formRef.value) {
          return;
        }
             const array = [props.surveydata];
            // let a1="";
        formRef.value.validate((valid: boolean) => {
          if (valid) {
            const date = new Date();
            loading.value = true;
            ApiService.post("updateTemplate", {
              id:props.id,
                title: newItem.value.title,
            detail:newItem.value.detail,
            user_id :localStorage.getItem('logged_user_id'),
            category: newItem.value.category,
            industrytype: newItem.value.industrytype,
            inspectiontype: newItem.value.inspectiontype,
            inspectionproperty: newItem.value.inspectionproperty,
            registeredproperty: newItem.value.registeredproperty,
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
                 hideModal(editSurveyModalRef.value);
                // router.push({name:"survey-details", params:{id:data}})
              });
            }, 2000);  

             })
           
            }
        });
      };
  
      return {
        newItem,
        rules,
        submit,
        formRef,
        loading,
        editSurveyModalRef,
        translate,
        lang
      };
    },
  });
  </script>
  