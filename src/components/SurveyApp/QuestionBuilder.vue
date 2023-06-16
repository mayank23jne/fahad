<template>
    <!--begin::Card-->
    <div :class="`card pt-4 mt-5`">
      <!--begin::Card header-->
      <div class="card-header border-0">
        <!--begin::Card title-->
        <!-- <h1>{{sort}}</h1> -->
        <div class="card-title">
            <span class="heading-number d-inline-block">{{sort}}</span>{{title}}
        </div>
        <!--end::Card title-->
  
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
          <!--begin::Filter-->
          <button
              class="btn btn-icon btn-active-light-info w-30px h-30px me-3"
              @click="changeMode('preview')"  v-if="mode=='edit'"
            >
              <span
                data-bs-original-title="Edit"
              >
              <i class="fa fa-eye me-1 text-info  fs-5"></i>

              </span>
            </button>
            <button
              
              class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
              @click="changeMode('edit')" v-if="mode == 'preview'"
            >
              <span
               
                data-bs-original-title="Preview"
              >
             
                <span class="svg-icon svg-icon-3 text-primary">
                  <inline-svg src="/media/icons/duotune/art/art005.svg" />
                </span>
              </span>
            </button>
            <!--end::Edit-->
            <!--begin::Delete-->
            <button
              class="btn btn-icon btn-active-light-danger w-30px h-30px me-3"
              @click="deletequestion(data.id)"
              data-kt-customer-payment-method="delete"
              data-bs-original-title="Delete"
            >
              <span class="svg-icon svg-icon-3 text-danger">
                <inline-svg src="/media/icons/duotune/general/gen027.svg" />
              </span>
            </button>
          <!-- <button
            type="button"
            class="btn btn-sm btn-flex btn-light-primary"
            data-bs-toggle="modal"
            data-bs-target="#kt_modal_add_payment"
          >
            <span class="svg-icon svg-icon-3">
              <inline-svg src="/media/icons/duotune/general/gen035.svg" />
            </span>
  
          </button> -->
          <button
            class="btn btn-icon btn-active-light-primary fw-bold rotate collapsible"
                data-bs-toggle="collapse"
                @click="showDetail = !showDetail"
                :href="`#questionCollapse${sort}`"
                role="button"
                :aria-expanded="showDetail ? 'true' : 'false'"
                :aria-controls="`questionCollapse${sort}`"
          >
           <span class="ms-2 rotate-180">
                  <span class="svg-icon svg-icon-3">
                    <inline-svg src="/media/icons/duotune/arrows/arr072.svg" />
                  </span>
                </span>
  
          </button>
          <!--end::Filter-->
        </div>
        <!--end::Card toolbar-->
      </div>
      <!--end::Card header-->
  
      <!--begin::Card body-->
      <div class="card-body pt-0 pb-5 collapse show" :id="`questionCollapse${sort}`">
        <div v-if="mode=='edit'" key="edit">
          <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">{{translate("thequestion")}} {{translate("arabic")}}</label>
            <input type="text" class="form-control form-control-solid" v-model="data.question" placeholder="Example input"/>
        </div>    
        <div class="mb-10">
            <label for="exampleFormControlInput1" class=" form-label">{{translate("thequestion")}} {{translate("english")}}</label>
            <input type="text" class="form-control form-control-solid" v-model="data.question_en" placeholder="Example input"/>
        </div>  
        <div class="separator mb-4"></div> 
        <div class="mb-10">
          <label for="exampleFormControlInput1" class="required form-label">{{translate("answertype")}}</label>          
          <select class="form-select" aria-label="Select example" 
          :options="questionTypes" v-model="data.answerType" >
          <template v-for="(option) in questionTypes" :key="option" :reduce="(option) => option.value" >
            <option :value="option.value">{{ option.label }}</option>
          </template>
          </select>      
        </div>      
        <div class="form-group" v-if="data.answerType">
          <label class="d-block">{{translate('theanswers')}}</label>
          <div class="answers mb-3 sortable">
            <div class="mb-1 position-relative" v-for="(a,index) in answers" :key="index">
              <div class="input-group mb-5">
                  <input type="text" class="form-control form-control-solid" :placeholder="translate('arabic')"  v-model="a.label" style="margin-right: 10px"/>
                  <input type="text" class="form-control form-control-solid" :placeholder="translate('english')" v-model="a.label_en"/>
                      <span class="badge badge-pill handle pr-0 mr-0"> <i class='fa fa-arrows text-muted'></i></span>
                      <span class="badge badge-pill text-danger" @click="deleteAnswer(a.value,index)"><i class="fa fa-ban me-1  fs-5 text-danger"></i></span>
                  </div>
              </div>
          </div>
          <div class="text-center">
            <button
            type="button"
            class="btn btn-sm btn-flex btn-light-primary"
            @click="addAnswer"
          >
            <span class="svg-icon svg-icon-3">
              <inline-svg src="/media/icons/duotune/general/gen035.svg" />
            </span>
            {{translate("addanswer")}}
          </button>
          </div>
          </div>
        </div>
        <div  v-else-if="mode=='preview'" key="preview">
          <label>{{question}}</label>
          <input type="text" key="text-input-preview" class="form-control form-control-solid"  v-if="data.answerType==0" placeholder="Example input"/>
          <select class="form-select" key="single-select-preview" aria-label="Select example" 
          :options="answers" v-else-if="data.answerType==1" >
          <template v-for="(option, index) in answers" :key="option"  >
            <option :value="option.value">{{ option.label }}</option>
          </template>
          </select>    
          <select class="form-select" key="multiple-select-preview" aria-label="Select example" 
          :options="answers" v-else-if="data.answerType==2" >
          <template v-for="(option) in answers" :key="option"  >
            <option :value="option.value">{{ option.label }}</option>
          </template>
          </select> 
          <div stacked key="checkbox-preview" v-else-if="data.answerType==3">
          <div v-for="(a,index) in answers" :key="`ans_${index}`" >
                      <input
                      class="form-check-input "
                      type="checkbox"
                      value={{a.value}}
                      id="flexcheck40"
                    />
                  <label class="form-check-label" for="flexcheck40">
                      {{a.label}}
                  </label>
                </div>    
          </div>  
          <div stacked key="radiobutton-preview" v-else-if="data.answerType==4">
          <div v-for="(a,index) in answers" :key="`ans_${index}`" >
                      <input
                      class="form-check-input "
                      type="radio"
                      value={{a.value}}
                      id="flexRadio40"
                    />
                  <label class="form-check-label" for="flexRadio40">
                      {{a.label}}
                  </label>
                </div>    
          </div>              
        </div>
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </template>

<script lang="ts">
import { defineComponent, onMounted, ref } from "vue";

import { Field } from "vee-validate";
import { useI18n } from "vue-i18n";



export default defineComponent({
  name: "question-builder",
  props: ['data', 'sort',"allquestions"],
  components: {
    Field,
    
  },
  setup(props){
    console.log('answers', props.data.answers);
       const title = ref("");
       const showDetail= ref<boolean>(false);
       const mode = ref<String>('edit');
       const question = ref('');
       const answers =  ref([{
           value:0,
           label:"",
           label_en:"",
       }]);
       const answerType = ref('');
       
       const { t, te } = useI18n();
        const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        }; 
        
       const questionTypes = [{ label: translate('text'), value: 0, options: false },
        { label: translate('choosemultiple'), value: 1, options: true },
        { label: translate('multiplechoice'), value: 2, options: true },
        ] 
       onMounted(() => {
        answers.value = props.data.answers;
       });  
   
     const changeMode =(mode1)=> {
      mode.value = mode1
      showDetail.value = true;
    }

    const deletequestion=(e)=>{
      var index = props.allquestions.questions.findIndex(function(o){
            return o.id === e;
          })
          if (index !== -1)
          {
            props.allquestions.questions.splice(index, 1);

          }
    }
  
    const deleteAnswer= (value,e)=> {
   
      answers.value.splice(e,1)
    }
 

      const addAnswer = ()=>
     {
     answers.value.push({
      "value": answers.value.length+1,
      "label":'',
      "label_en":''
     });

      // data.answers.push({ value: data.answers.length + 1, label: '' })
    } 
  return {
    title,
    showDetail,
    addAnswer,
    mode,
    changeMode,
    deletequestion,
    questionTypes,
    deleteAnswer,
    question,
    answers,
    translate
    };
  },
});
</script>