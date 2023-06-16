<template>
    <div
      class="modal fade"
      id="kt_modal_add_inspectionproperty"
      ref="addInspectionPropertyModalRef"
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
            <h2 class="fw-bold">{{translate('addinspectionpropertytype')}}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_add_inspectionproperty_close"
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
                id="kt_modal_add_industryproperty_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_add_inspectionproperty_header"
                data-kt-scroll-wrappers="#kt_modal_add_inspectionproperty_scroll"
                data-kt-scroll-offset="300px"
              >
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="required fs-6 fw-semobold mb-2">{{translate('name')}}({{translate('arabic')}})</label>
                  <el-form-item prop="propertyname_ar">
                    <el-input
                      v-model="newItem.propertyname_ar"
                      type="text"
                      name="propertyname_ar"
                      placeholder=""
                    />
                  </el-form-item>
                </div> 
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fs-6 fw-semobold mb-2">{{translate('name')}}({{translate('english')}})</label>
                  <el-form-item prop="propertyname_en">
                    <el-input
                      v-model="newItem.propertyname_en"
                      type="text"
                      name="propertyname_en"
                      placeholder=""
                    />
                  </el-form-item>
                </div>
                <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('selectowner')}}</span>
                    </label>
                   
                    <el-form-item prop="owner">
                    <!--begin::Input-->
                    <el-input
                      v-model="newItem.owner"
                      type="text"
                      name="owner"
                      placeholder=""
                    />
                    <!-- <el-select v-model="newItem.category" :options="categories" >
                      <template v-for="category in categories" :key="category">
                        <el-option :value="category.value">{{ category.label }}</el-option>
                    </template>
                    </el-select> -->
                    </el-form-item>
                    <!--end::Input-->
                  </div>
                  <div class="d-flex flex-column mb-7 fv-row">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semobold mb-2">
                      <span class="required">{{translate('selectindustrytype')}}</span>
                    </label>
                   
                    <el-form-item prop="industrytype">
                    <!--begin::Input-->
                    <el-select v-model="newItem.industrytype" :options="industry_type"  :popper-append-to-body="false"
                     :teleported="false">
                      <template v-for="(industry) in industry_type" :key="industry.id">
                        <el-option :value="industry.id" v-if="lang=='en'|| lang == 'enrtl'" :label=" industry.name_en">{{ industry.name_en }}</el-option>
                        <el-option :value="industry.id" v-else :label="industry.name_ar ">{{ industry.name_ar }}</el-option>
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
                id="kt_modal_add_inspectionproperty_cancel"
                class="btn btn-light me-3"
                @click="cancelprocess()"
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
  import { translate } from "element-plus";
  import { useI18n } from "vue-i18n";



   
  interface newItem{
        propertyname_en:string;
        propertyname_ar:string;
        owner:string;
        industrytype:string;
  }


  export default defineComponent({
    name: "add-inspectionproperty-modal",
    components: {},
    props:['inspectionproperty', 'industry_type'],
   

    setup(props, {emit}) {
      const formRef = ref<null | HTMLFormElement>(null);
      const addInspectionPropertyModalRef = ref<null | HTMLElement>(null);
      const lang = localStorage.getItem('lang');
      const loading = ref<boolean>(false);
      const successmessage=ref<boolean>(false);
        const user_id = localStorage.getItem('logged_user_id')  as string;
        const { t, te } = useI18n();
        const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };
      const newItem = ref<newItem>({ propertyname_en:'',
        propertyname_ar:'',
        owner:'',
        industrytype:'',});
      const rules = ref({
        propertyname_ar: [
          {
            required: true,
            message: translate('name_ar_req'),
            trigger: "change",
          },
        ],
        // propertyname_en: [
        //   {
        //     required: true,
        //     message: translate('name_en_req'),
        //     trigger: "change",
        //   },
        // ],
        owner: [
          {
            required: true,
            message: translate('ownerreq'),
            trigger: "change",
          },
        ],
        industrytype: [
          {
            required: true,
            message: translate('industryreq'),
            trigger: "change",
          },
        ],
      });

      const cancelprocess = () =>
       {
          hideModal(addInspectionPropertyModalRef.value);

       }
  
      const submit = () => {
        if (!formRef.value) {
          return;
        }
             const array = [props.inspectionproperty];
            // let a1="";
        formRef.value.validate((valid: boolean) => {
          if (valid) {
            // const date = new Date();
         //   let data = 30;
            loading.value = true;
            ApiService.post("createInspectionProperty", {
                name_en: newItem.value.propertyname_en,
                name_ar:newItem.value.propertyname_ar,
                owner:newItem.value.owner,
                industry_type:newItem.value.industrytype,
                user_id:user_id})
        .then(({ data }) => 
            {
              props.inspectionproperty.push({
                'created_at': data.created_at,
                'id' : data.id,
                'industry_type': data.industry_type,
               'is_deleted': "0",
               'owner': data.owner,
              'propertyname_ar': data.propertyname_ar, 
              'propertyname_en': data.propertyname_en,
              'status':"1",
                'updated_at': data.updated_at,
                'user_id':data.user_id,
                })
              
      

      setTimeout(() => {
              loading.value = false;
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
                hideModal(addInspectionPropertyModalRef.value);
                newItem.value = {
                propertyname_ar: "",
                propertyname_en: "",
                owner:"",
                industrytype:"",
              };
              });
            }, 2000);  

             })
              
              .catch(({ response }) => {
              });
            }
        });
      };
  
      return {
        newItem,
        rules,
        submit,
        formRef,
        loading,
        addInspectionPropertyModalRef,
        translate,
        lang,
        cancelprocess
      };
    },
  });
  </script>
  