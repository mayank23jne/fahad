<template>
  <div class="d-flex flex-column flex-end flex-xl-row mb-5" style="margin-top:-62px;">
    <button class="btn btn-primary ps-7 flex-start" @click="savequestion"> {{translate("save")}} </button>
     
  </div>
  
    <div class="d-flex flex-column flex-xl-row">
      
      
      <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
       
        <div class="card mb-5 mb-xl-8">
       
          <div class="card-body pt-15">
        
            <div class="d-flex flex-center flex-column mb-5">
               
              <div class="fs-5 fw-bold  mb-6" v-if="currentSurvey">
                <h1 >
                <i style="width: 34px;
                height: 34px;
                font-size: 20px;
                color: #008ecc;
                margin-right: 5px;
                line-height: inherit;
                vertical-align: middle;"
                  :class="{
                    'heading-icons': true,
                    'fa fa-check-circle': currentSurvey.status === 'COMPLETED',
                    'fa fa-refresh': currentSurvey.status !== 'COMPLETED'
                  }"
                ></i>
                <span class="align-middle d-inline-block pt-1">{{ currentSurvey.title }}</span>
              </h1>
                <!-- {{ currentSurvey.title }} -->
              </div>
            </div>
           
            <div class="d-flex flex-stack fs-4 py-3">
              <div
                class="fw-bold rotate collapsible"
                data-bs-toggle="collapse"
                href="#kt_customer_view_details"
                role="button"
                aria-expanded="false"
                aria-controls="kt_customer_view_details"
              >
                {{translate("summary")}}
                <span class="ms-2 rotate-180">
                  <span class="svg-icon svg-icon-3">
                    <inline-svg src="/media/icons/duotune/arrows/arr072.svg" />
                  </span>
                </span>
              </div>
  
              <span data-bs-toggle="tooltip"
                data-bs-trigger="hover"
                title="Edit"
              >
                <button
                type="button"
                  class="btn btn-sm btn-light-primary "
                  data-bs-toggle="modal"
                  data-bs-target="#kt_modal_newedit_survey"
                >
                  {{translate("edit")}}
                </button>
              </span>
               
            </div>
           
  
            <div class="separator separator-dashed my-3"></div>
  
           
            <div id="kt_customer_view_details" class="collapse show">
              <div class="py-5 fs-6">
                
                <div class="fw-bold mt-5">{{translate('title')}}</div>
                <div class="text-gray-600">{{currentSurvey.title}}</div>
            
                <div class="fw-bold mt-5">{{translate("details")}}</div>
                <div class="text-gray-600">
                  {{currentSurvey.detail}}
                </div>
             
                <!-- <div class="fw-bold mt-5">{{translate('cat')}}</div>
                <div class="text-gray-600">
                {{currentSurvey.category}}
                </div> -->
                <div class="fw-bold mt-5">{{translate('industrytype')}}</div>
                <div class="text-gray-600" v-if="lang == 'en'|| lang == 'enrtl'">
                {{industry && industry.name_en}}
                </div>
                <div class="text-gray-600" v-else>
                {{industry && industry.name_ar}}
                </div>
                <div class="fw-bold mt-5">{{translate('inspectiontype')}}</div>
                <div class="text-gray-600" v-if="lang == 'en'|| lang == 'enrtl'">
                  {{inspectiontype && inspectiontype.name_en}}
                </div>
                <div class="text-gray-600"  v-else>
                  {{inspectiontype && inspectiontype.name_ar}}
                </div>
                <div class="fw-bold mt-5">{{translate('inspectionpropertytype')}}</div>
                <div class="text-gray-600" v-if="lang == 'en'|| lang == 'enrtl'">
                {{inspectionproperty && inspectionproperty.propertyname_en}}
                </div>
                <div class="text-gray-600"  v-else>
                {{inspectionproperty && inspectionproperty.propertyname_ar}}
                </div>
                <div class="fw-bold mt-5">{{translate('registeredproperty')}}</div>
                <div class="text-gray-600">
                  {{registeredproperty && registeredproperty.building_no}}
                </div>
                <!-- <div class="text-gray-600"  v-else>
                  {{registeredproperty && registeredproperty.propertyname_ar}}
                </div> -->
                <div class="fw-bold mt-5">{{translate('offices')}}</div>
                <div class="text-gray-600">
                  {{offices && offices.property_list}}
                </div>
              </div>
            </div>
          
          </div>
       
        </div> 
  
      </div>
     
  
      <!--begin::Content-->
      <div class="flex-lg-row-fluid ms-lg-15">
       
        <!--begin:::Tabs-->
        <!-- <ul
          class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semobold mb-8"
        > -->

          <!--begin:::Tab item-->
          <!-- <li class="nav-item ms-auto"> -->
            <!--begin::Action menu-->
            
            <!-- <Dropdown3></Dropdown3> -->
            <!--end::Menu-->
          <!-- </li> -->
          <!--end:::Tab item-->
        <!-- </ul> -->
        <!-- end:::Tabs -->
  
        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
          <!--begin:::Tab pane-->
          <div
            class="tab-pane fade show active"
            id="kt_customer_view_overview_tab"
            role="tabpanel"
          >
          <!-- <div v-for="(question, index) in currentSurvey.questions"  :key="`question_${index}`"
            >
            {{ index + 1 }}
          </div> -->
          <QuestionBuilder  v-for="(question, index) in currentSurvey.questions" :key="`question_${index}`"
            :data="question"
            :sort="index + 1"
            :allquestions="currentSurvey"
            ></QuestionBuilder>
            <div class="col-md-12">
              <button
            type="button"
            class="btn btn-sm btn-flex btn-light-primary text-center"
            @click="addQuestion"
          >
            <span class="svg-icon svg-icon-3">
              <inline-svg src="/media/icons/duotune/general/gen035.svg" />
            </span>
            {{translate('addquestions')}}
          </button>
            </div>
            
          </div>
        
        </div>
        <!--end:::Tab content-->
      </div>
      <!--end::Content-->
    </div>
    <!--end::Layout-->
    <EditNewSurveyModal :categories="category"  :currentSurvey="currentSurvey" :labels="labels" :statuses="statuses" :industrytype="industrytype"
      :inspectiontype ="inspectiontypes"
       :inspectionproperty="inspectionproperties"
       :registeredproperty="registeredproperties"
       :officelist="officelist && officelist" :id="id"  @update="updateItem"></EditNewSurveyModal>
    <!-- <EditSurveyModal :categories="category"  :currentSurvey="currentSurvey" :labels="labels" :statuses="statuses" :industrytype="industrytype"
      :inspectiontype ="inspectiontypes"
       :inspectionproperty="inspectionproperties"
       :registeredproperty="registeredproperties" :id="id"  @update="updateItem"></EditSurveyModal> -->
    <NewCardModal></NewCardModal>
  </template>
  
  <script lang="ts">
  import { defineComponent, onMounted, ref, watch } from "vue";
  import Dropdown3 from "@/components/dropdown/Dropdown3.vue";
  import NewCardModal from "@/components/modals/forms/NewCardModal.vue";
  import PaymentRecords from "@/components/customers/cards/overview/PaymentRecords.vue";
  import PaymentMethods from "@/components/customers/cards/overview/PaymentMethods.vue";
  import CreditBalance from "@/components/customers/cards/overview/CreditBalance.vue";
  import Invoices from "@/components/customers/cards/overview/Invoices.vue";
  
  import Events from "@/components/customers/cards/events-and-logs/Events.vue";
  import Logs from "@/components/customers/cards/events-and-logs/Logs.vue";
  // import EditSurveyModal from "@/containers/applications/EditSurveyModal.vue";
  import EditNewSurveyModal from "@/containers/applications/EditNewSurveyModal.vue";
  import Earnings from "@/components/customers/cards/statments/Earnings.vue";
  import Statement from "@/components/customers/cards/statments/Statement.vue";
import ApiService from "@/core/services/ApiService";
import QuestionBuilder from "@/components/SurveyApp/QuestionBuilder.vue";
import { useSurveyStore } from "@/stores/survey";
import { storeToRefs } from 'pinia';
import { useI18n } from "vue-i18n";
import Swal from "sweetalert2";

interface questions{
    answerType:number;
    answers:[];
     choose:[];
     id:number;
     image:[];
     notes:null;
     operation_id:string;
     question:string;
     question_en:string;
     title:string;
}

  interface currentSurvey{
    id:number;
    user_id:number | any;
    title:string | any;
    detail:string;
    category:string;
    date:string;
    questions:questions [];
    status:string;
    industrytype: string;
inspectionproperty: string;
inspectiontype: string;
registeredproperty: string;
officefield:string;

  }

  export default defineComponent({
    name: "survey-details",
    props:['id'],
    components: {
      PaymentRecords,
      PaymentMethods,
      CreditBalance,
      Invoices,
      Events,
      Logs,
      Earnings,
      Statement,
      Dropdown3,
      NewCardModal,
      QuestionBuilder,
      // EditSurveyModal,
      EditNewSurveyModal
    },
    setup(props){
     const lang = localStorage.getItem('lang');
      const newform=ref("");
     const categories=ref([
        {
          label: "Development",
          value: "Development"
        },
        {
          label: "Workplace",
          value: "Workplace"
        },
        {
          label: "Hardware",
          value: "Hardware"
        }
      ]);
      const labels= ref([
        {
          label: "EDUCATION",
          value: "EDUCATION",
          color: "secondary"
        },
        {
          label: "NEW FRAMEWORK",
          value: "NEW FRAMEWORK",
          color: "primary"
        },
        {
          label: "PERSONAL",
          value: "PERSONAL",
          color: "info"
        }
      ]);
      const statuses= ref([
        {
          text: "ACTIVE",
          value: "ACTIVE"
        },
        {
          text: "COMPLETED",
          value: "COMPLETED"
        }
      ]);

      const category= ref([
      {
          label: "موارد بشرية",
          value: "موارد بشرية"
        },
        {
          label: "اماكن",
          value: "اماكن"
        },
        {
          label: "اجهزة",
          value: "Hardware"
        }
      ]);

      const  tabIndex = ref(0);
      const store = useSurveyStore();
      const { isLoadSurveys } = storeToRefs(store)
      const currentSurvey = ref<currentSurvey>({
            id:0,
            user_id:0,
            title:"",
            detail:"",
            category:"",
            date:"",
            questions: [],
            status:'',
            industrytype: '',
          inspectionproperty: '',
          inspectiontype: '',
          registeredproperty: '',
          officefield:'',
        });
        const industry = ref<any>({});
          const inspectionproperty = ref<any>({});
            const inspectiontype = ref<any>({});
              const registeredproperty = ref<any>({});
                const industrytype = ref<any>([]);
                  const offices = ref<any>([]);
                  const officelist = ref<any>([]);
      const inspectiontypes = ref<any>([]);
      const inspectionproperties = ref<any>([]);
      const registeredproperties = ref<any>([]);
        const user_id = localStorage.getItem('logged_user_id')  as string;
        const { t, te } = useI18n();
        const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        }; 


        watch(isLoadSurveys, (currentValue, oldValue) => {
         
      if(currentValue === true) {
        let id = props.id
        let name = store.surveyItems.filter((x:any)=>x.id==id)
         currentSurvey.value =  store.surveyItems[--id]
    }
        });
        onMounted(async() => {
        let id= props.id;
       await ApiService.get(`show/${id}`)
      .then(({ data }) => {
        // console.log('survey data', data);
        currentSurvey.value = data;
    
         ApiService.post("showIndustryTypeId",{id:data.industrytype, user_id:user_id})
    .then(({ data }) => {
        industry.value = data[0];
       });
     
        ApiService.post("showInspectionPropertyId",{id:data.inspectionproperty, user_id:user_id})
    .then(({ data }) => {
        inspectionproperty.value = data[0];
       });

       ApiService.post("showRegisteredPropertyId",{id:data.registeredproperty, user_id:user_id})
    .then(({ data }) => {
        registeredproperty.value = data[0];
       });

       ApiService.post("showInspectionTypeById",{id:data.inspectiontype})
    .then(({ data }) => {
        inspectiontype.value = data[0];
       });

       ApiService.post('showIndustryType',{user_id:user_id})
        .then(({ data }) => {
          industrytype.value = data;
        })
        .catch(({ response }) => {
          
        });

        ApiService.get('showAllInspectionTypes')
        .then(({ data }) => {
          inspectiontypes.value = data;
        })
        .catch(({ response }) => {
          
        });

        ApiService.post('showInspectionProperty',{user_id:user_id})
        .then(({ data }) => {
          inspectionproperties.value = data;
        })
        .catch(({ response }) => {
          
        });

        ApiService.post('showRegisteredProperty',{user_id:user_id})
        .then(({ data }) => {
          registeredproperties.value = data;
        })
        .catch(({ response }) => {
          
        });

        ApiService.post('showRegisteredFieldId',{id:data.registeredproperty})
        .then(({ data }) => {
         // console.log('sdfsgdata', data);
          if(data){
          officelist.value = data;
        }
        })
        .catch(({ response }) => {  
        });

        ApiService.post('showRegisteredFieldbyId',{id:data.officefield})
        .then(({ data }) => {
         // console.log('officedaya', data[0]);
          offices.value = data[0];
        })
        .catch(({ response }) => {
          
        });

      })
   

     
      });
    //   .catch(({ response }) => {
        
    //   });
    // });

    const updateItem=()=>{

    }


    const savequestion=()=>
    { 
      currentSurvey.value.questions.forEach((val,index)=>
      {

        if(val.answerType == 0)
        {
          val.answers=[]
        }

      })
      // setHeaderAuth();
     
     currentSurvey.value.user_id = localStorage.getItem('logged_user_id')
     let data = currentSurvey.value;

     ApiService.post('update', data)
      .then(({ data }) => {
        // currentSurvey.value = data;
        if(data.message === "your forms successfully updated"){
          setTimeout(() => {
                    Swal.fire({
                    text:translate('savedsuccess'),
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText:translate('okgotit'),
                    heightAuto: false,
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                    }).then(() => {
                    // router.push({ name: "SurveyList" });
                    });
                }, 500);
        }
      })
            
    }

    const addQuestion=() =>{
      currentSurvey.value.questions.push({
id: currentSurvey.value.questions.length + 1,
title: "",
question: "",
question_en: "",
answerType: 0,
answers: [],
choose: [],
image: [],
notes: null,
operation_id: ""
});

      }

    return {
        currentSurvey,
        addQuestion,
        savequestion,
        translate,
        industry,
        inspectionproperty ,
        inspectiontype,
        registeredproperty,
        lang,
        industrytype,
        inspectionproperties ,
        inspectiontypes,
        registeredproperties,
        category,
        statuses,
        labels,
        updateItem,
        offices,
        officelist
      };
    },
  });
  </script>
 <style scss>
 .heading-number{
   border: 1px solid #008ecc;
   padding: 4px;
   vertical-align: middle;
   margin-right: 10px;
   border-radius: 20px;
   width: 34px;
   height: 34px;
   text-align: center;
   color: #008ecc;
 }
 .heading-icons {
  width: 34px;
   height: 34px;
  font-size: 20px;
  color: #008ecc;
  margin-right: 5px;
  line-height: inherit;
  vertical-align: middle;
}
</style>