<template>
    <div
      class="modal fade"
      id="kt_modal_add_survey"
      ref="addSurveyModalRef"
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
            <h2 class="fw-bold">{{translate('addnewsurvey')}}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_add_survey_close"
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
                id="kt_modal_add_survey_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_add_survey_header"
                data-kt-scroll-wrappers="#kt_modal_add_survey_scroll"
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
                <!-- <div class="d-flex flex-column mb-7 fv-row">
                  
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('cat')}}</span>
                    </label>
                   
                    <el-form-item prop="category">
                  
                    <el-select v-model="newItem.category" :options="categories" :popper-append-to-body="false"
                     :teleported="false">
                      <template v-for="category in categories" :key="category">
                        <el-option :value="category.value">{{ category.label }}</el-option>
                    </template>
                    </el-select>
                    </el-form-item>
                 
                  </div> -->

                  <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('industrytype')}}</span>
                    </label>
                   
                    <el-form-item prop="industrytype">
                    <!--begin::Input-->
                    <el-select v-model="newItem.industrytype" :options="industrytype" :popper-append-to-body="false"
                     :teleported="false">
                      <template v-for="industry in industrytype" :key="category">
                        <el-option :value="industry.id" v-if="lang == 'en' || lang == 'enrtl'" :label="industry.name_en">{{ industry.name_en}}</el-option>
                        <el-option :value="industry.id" v-else  :label="industry.name_ar">{{ industry.name_ar}}</el-option>
                    </template>
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
                    <el-select v-model="newItem.inspectiontype" :options="inspectiontype.name_en" :popper-append-to-body="false"
                     :teleported="false">
                      <template v-for="ins in inspectiontype" :key="ins">
                        <el-option :value="ins.id" v-if="lang == 'en' || lang == 'enrtl'" :label="ins.name_en">{{ ins.name_en}}</el-option>
                        <el-option :value="ins.id" v-else  :label="ins.name_ar">{{ ins.name_ar}}</el-option>
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
                    <el-select v-model="newItem.inspectionproperty" :options="inspectionproperty" :popper-append-to-body="false"
                     :teleported="false">
                      <template v-for="inspection in inspectionproperty" :key="inspection">
                        <el-option :value="inspection.id" v-if="lang == 'en' || lang == 'enrtl'" :label="inspection.propertyname_en">{{ inspection.propertyname_en}}</el-option>
                        <el-option :value="inspection.id" v-else :label="inspection.propertyname_ar">{{ inspection.propertyname_ar}}</el-option>
                    </template>
                    </el-select>
                    </el-form-item>
                    <!--end::Input-->
                  </div>
                  <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="">{{translate('registeredproperties')}}</span>
                    </label>
                   
                    <el-form-item prop="registeredproperty">
                    <!--begin::Input-->
                    <el-select v-model="newItem.registeredproperty" :options="registeredproperty" :popper-append-to-body="false"
                     :teleported="false" @change="onRegisteredChange">
                      <template v-for="register in registeredproperty" :key="register.id">
                        <el-option :value="register.id" :label="register.building_no">{{ register.building_no}}</el-option>
                        <!-- <el-option :value="register.id" v-else>{{ register.propertyname_ar}}</el-option> -->
                    </template>
                    </el-select>
                    </el-form-item>
                    <!--end::Input-->
                  </div>
                  <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="">{{translate('offices')}}</span>
                    </label>
                   
                    <el-form-item prop="officefield">
                    <!--begin::Input-->
                    <el-select v-model="newItem.officefield" :options="officelist" :popper-append-to-body="false"
                     :teleported="false">
                      <template v-for="office in officelist" :key="office.id">
                        <el-option :value="office.id" :label="office.property_list">{{ office.property_list}}</el-option>
                        <!-- <el-option :value="register.id" v-else>{{ register.propertyname_ar}}</el-option> -->
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
                id="kt_modal_add_survey_cancel"
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
  import { defineComponent, ref } from "vue";
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
        officefield:string,
  }

  interface officelist{
    id:number;
no_of_people: string;
property_list: string;
registered_id: string;
  }


  export default defineComponent({
    name: "add-survey-modal",
    components: {},
    props:['categories', 'statuses', 'surveydata', "industrytype", "inspectiontype", "inspectionproperty", "registeredproperty"],
   

    setup(props, {emit}) {
      const formRef = ref<null | HTMLFormElement>(null);
      const addSurveyModalRef = ref<null | HTMLElement>(null);
      const loading = ref<boolean>(false);
      const lang= localStorage.getItem('lang') as string;
      const officelist= ref<any>([]
        // id:0,
        // no_of_people: '',
        // property_list: '',
        // registered_id: '',
      )
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
        registeredproperty: "",
        officefield:"" });
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
            message: translate('selectindustrytype'),
            trigger: "change",
          },
        ],
        inspectiontype:[
          {
            required: true,
            message: translate('selectinspectiontype'),
            trigger: "change",
          },
        ],
        inspectionproperty:[
          {
            required: true,
            message: translate('selectinspectionproperty'),
            trigger: "change",
          },
        ],
        // registeredproperty:[
        //   {
        //     required: true,
        //     message: translate('selectregisteredproperty'),
        //     trigger: "change",
        //   },
        // ],
        // officefield:[]
      });

      const onRegisteredChange = (e) =>{
        ApiService.post("showRegisteredFieldId", {
                id: e}) .then(({ data }) => 
            {
              officelist.value = data;
              console.log('fields', data);
            })
      }
  
      const submit = () => {
        if (!formRef.value) {
          return;
        }
             const array = [props.surveydata];
            // let a1="";
        formRef.value.validate((valid: boolean) => {
          if (valid) {
            const date = new Date();
         //   let data = 30;
            loading.value = true;
            ApiService.post("create", {
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
              props.surveydata.push({
                "id": data,
                  "title": newItem.value.title,
                  "detail": newItem.value.detail,
                  "answers_count": 0,
                  "category": newItem.value.category,
                  "date": date.getDay() + "." + date.getMonth() + 1 + "." + date.getFullYear(),
                  "questions": []
                })
              
      

      setTimeout(() => {
              loading.value = false;
              newItem.value = {
                title: "",
                category: "",
                detail: "",
                status: "",
                industrytype: "",
                inspectiontype: "",
                inspectionproperty: "",
                registeredproperty: "",
                officefield:"",
              };
              formRef.value?.resetFields();
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
                 hideModal(addSurveyModalRef.value);
                router.push({name:"survey-details", params:{id:data}})
              });
            }, 2000);  

             })
              
            //   .catch(({ response }) => {
            //   });
            }
        });
      };
  
      return {
        newItem,
        rules,
        submit,
        formRef,
        loading,
        addSurveyModalRef,
        translate,
        onRegisteredChange,
        lang,
        officelist
      };
    },
  });
  </script>
  