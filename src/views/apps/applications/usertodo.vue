<template>
  <!--begin::Basic info-->
  <div class="card mb-5 mb-xl-10">
    <div id="kt_account_profile_details" class="collapse show">
      <!--begin::Form-->
      <VForm
        id="kt_account_profile_details_form"
        class="form"
        novalidate
        @submit="submit"
        :model="userData"
          
      >
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-semobold fs-6"
              >{{translate("thedetails")}}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
                type="text"
                name="detail"
                class="form-control form-control-lg form-control-solid"
                placeholder="Company name"
                v-model="userData.detail"
                readonly
              />
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="detail" />
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
              >{{translate('thedate')}}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
                type="text"
                name="Date"
                class="form-control form-control-lg form-control-solid"
                placeholder="Date"
                v-model="userData.Date"
                
              />
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="Date" />
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
                  >{{ translate('taskname') }}</label
                >
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                  <Field
                    type="text"
                    name="question"
                    class="form-control form-control-lg form-control-solid"
                    placeholder="question"
                    v-model="userData.question"
                  />
                  <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="question" />
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
              >{{translate('thecondition')}}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
              as="select"
                name="status"
                class="form-select form-select-solid form-select-lg fw-semobold"
                :options="statuslist"
                    v-model="userData.status"
                > 
                      <template v-for="(status) in statuslist" :key="status">
                        <option :value="status.status">{{ status.label }}</option>
                      </template>
              
              </Field>
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="condition" />
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
              >{{translate("comments")}}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
              type="text"
                 
                name="notes"
                class="form-control form-control-lg form-control-solid"
                placeholder="Company website"
                v-model="userData.notes"
              />
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="notes" />
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
              >{{ translate('attachfile') }}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <Field
                type="file"
                name="image"
                class="form-control form-control-lg form-control-solid"
                placeholder="Company website"
                v-model="userData.image"
              />
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="image" />
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
              >{{translate("tobesure")}}</label
            >
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <!--begin::Options-->
              <div class="d-flex align-items-center mt-3">
                <!--begin::Option-->
                  <input
                  v-if="confirmtask"
                  id="checkbox-1"
                     class="form-check-input"
                    name="checkbox-1"
                    value="1"
                    unchecked-value="0"
                    type="checkbox"
                    v-model="userData.confirm"
                  />
                <!--end::Option-->

                <!--begin::Option-->
                <div class="col-lg-10 fv-row" style="margin-left:20px;">
                <Field
                type="text"
                name="monitorNotes"
                class="form-control form-control-lg form-control-solid"
                placeholder="Company website"
                v-model="userData.monitorNotes"
               />
              <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                  <ErrorMessage name="monitorNotes" />
                </div>
              </div>
            </div>
                <!--end::Option-->
              </div>
              <!--end::Options-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->

          <!--begin::Input group-->
          <div class="row mb-0">
          

            <!--begin::Label-->
            <!-- <label class="col-lg-4 col-form-label fw-semobold fs-6"
              >Allow Marketing</label
            > -->
            <!--begin::Label-->

            <!--begin::Label-->
            <div class="col-lg-6 d-flex align-items-center">
              <img v-if="userData.imageAnswer==''"
                src="https://www.w3schools.com/images/lamp.jpg"
                @click="onImageClick($data)" style="height: 100px; width: 100px;"
                  />
                <img v-else :src="'https://forms.innovativeideasbox.com/API/public/uploads/' + userData.imageAnswer" style="height: 100px; width: 100px;">

            </div>
            <div class="col-lg-6 d-flex align-items-center">
              <img v-if="userData.image==''"
                  src="https://www.w3schools.com/images/lamp.jpg"
                  @click="onImageClick($data)" style="height: 100px; width: 100px;"
                    />
                  <img v-else :src="'https://forms.innovativeideasbox.com/API/public/uploads/' + userData.tempImage" style="height: 100px; width: 100px;">

            </div>
            <!--begin::Label-->
          </div>
          <!--end::Input group-->
        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
          <!-- <button
            type="reset"
            class="btn btn-light btn-active-light-primary me-2"
          >
            Discard
          </button> -->

          <button
            type="submit"
            id="kt_account_profile_details_submit"
            ref="submitButton1"
            class="btn btn-primary"
          >
            <span class="indicator-label"> {{translate("save")}} </span>
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
<!-- <template> -->
  <!--begin::Card-->
  <!-- <div class="card"> -->
    <!--begin::Card body-->
    <!-- <div class="card-body p-0"> -->
      <!--begin::Heading-->
      <!-- <div class="card-px text-center py-20 my-10"> -->
        <!--begin::Title-->
        <!-- <div class="d-flex justify-content-between"> -->
          <!-- <h6>{{ userData.status }}</h6> -->
        <!-- <h2 class="fs-2x fw-bold mb-10">{{translate('missiondetails')}}</h2> -->
        <!--end::Title-->
        <!-- <RouterLink to="/"><span class="logo-single" /></RouterLink> -->
        <!-- </div> -->
        <!--begin::Description-->
       
        <!--begin::Form-->

        <!--end::Form-->
        <!--end::Action-->
      <!-- </div> -->
      <!--end::Heading-->

      <!--begin::Illustration-->
      <!-- <div class="text-center px-5">
        <img :src="image" alt="" class="mw-100 mh-300px" />
      </div> -->
      <!--end::Illustration-->
    <!-- </div> -->
    <!--end::Card body-->
  <!-- </div> -->
  <!--end::Card-->
<!-- </template> -->

  



<script lang="ts">
import { defineStore } from "pinia";
import { defineComponent, ref, onMounted, toRaw } from "vue";
import { ErrorMessage, Field, Form as VForm } from "vee-validate";
import { useRouter } from "vue-router";
import Datatable from "@/components/kt-datatable/KTDataTable.vue";
import { hideModal } from "@/core/helpers/dom";
import * as Yup from "yup";
import Swal from "sweetalert2";
import ApiService from "@/core/services/ApiService";
import JwtService from "@/core/services/JwtService";
import { dataType } from "element-plus/es/components/table-v2/src/common";
import { useI18n } from "vue-i18n";

interface userData {
  Date: string;
  confirm: string;
  detail: string;
  image: string;
  imageAnswer:string;
  monitor_id:string;
  notes:string;
  question:string;
  status:string;
  task_id:string;
  tempImage:string;
  monitorNotes:string;
}

export default defineComponent({
  name: "usertodo",
  props:['id'],
  components: {
    Datatable,
    ErrorMessage,
    Field,
    VForm,
    // ExportCustomerModal,
    // AddCustomerModal,
  },
  setup(props) {
      //  const store = useTodoStore();
      const submitButtonRef = ref<null | HTMLButtonElement>(null);
    const modalRef = ref<null | HTMLElement>(null);
    const createAPIKeyModalRef = ref<null | HTMLElement>(null);

    const router = useRouter();
   const roleid = localStorage.getItem('role_id');
   const confirmtask=ref<boolean>(false);
   const tododata =  "";

   const { t, te } = useI18n();
        const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        }; 

  // const userData  = ref();
     const statuslist=ref([
        {
          status:1,
          label:translate('completed')
        },
        {
          status:2,
          label:translate('suspended')
        },
        {
          status:3,
          label:translate('notdone')
        },

        ]);
  
   const currentPage = ref<number>(1);
   const totalRows = ref<number>(0);
    const selectedIds = ref<Array<number>>([]);
      let persmis= ref( localStorage.getItem('permissions')?.split(','));
      const userData = ref<userData>({
        Date: "",
        confirm: "",
        detail: "",
        image: "",
        imageAnswer:"",
        monitor_id:"",
        notes:"",
        question:"",
        status:"0",
        task_id:"0",
        tempImage:"",
        monitorNotes:"",
    });

    onMounted( () => {
    if(persmis.value?.indexOf("4") !== -1)
{
        confirmtask.value=true;
}
      return ApiService.get(`showTask/${props.id}`)
      .then(({ data }) => {
        userData.value = data[0];
        userData.value.tempImage = data[0].image;
      })
      .catch(({ response }) => {
        
      });
    });

    const onImageClick = (image) => {
      
    }

    // const validationSchema = Yup.object().shape({
    //   apiName: Yup.string().required().label("API name"),
    //   shortDescription: Yup.string().required().label("Description"),
    //   category: Yup.string().required().label("Category"),
    //   apiMethod: Yup.string().required().label("API method"),
    // });

    const submit = () => {
      let user_id = localStorage.getItem('logged_user_id') as string;
      // if (!submitButtonRef.value) {
      //   return;
      // }
      const data:any = new FormData;
      data.append('status',userData.value.status)
     data.append('notes',userData.value.notes)
      data.append('image',null)
       data.append('task_id',userData.value.task_id)
        data.append('confirm',userData.value.confirm)
        data.append('monitor_id',user_id);
      data.append('monitorNotes',userData.value.monitorNotes)
    
      
      return ApiService.post("updateTask", data)
      .then(({ data }) => {
        if(data == 'success'){
          setTimeout(() => {
        Swal.fire({
          text:translate('savedsuccess'),
          icon: "success",
          buttonsStyling: false,
          confirmButtonText: translate('okgotit'),
          heightAuto: false,
          customClass: {
            confirmButton: "btn btn-primary",
          },
        }).then(() => {
          router.push({ name: "todolist" });
        });
      }, 2000);
        }
      })
      .catch(({ response }) => {
        
      });

    };

    return {
        userData,
        router,
        tododata,
        confirmtask,
        statuslist,
    //  validationSchema,
      onImageClick,
      submit,
      submitButtonRef,
      modalRef,
      createAPIKeyModalRef,
      translate,
    };
  },
});
</script>
  