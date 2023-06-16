<template>
  <div class="card">
    <div class="card-header border-0 pt-6">
      <!--begin::Card title-->
      <div class="card-title">
        <!--begin::Search-->
       
        <div style="font-weight:bold;font-size:20px" class="mb-3 d-flex justify-content-center">
            {{title}}
        </div>
        
        <!--end::Search-->
      </div>
      <!--begin::Card title-->
    
    </div>
    <div class="card-body pt-0">
     
        <div style="font-size: 18px" class="row">
          
        <div class="col-lg-4 fv-row">
        <label class="col-lg-4 col-form-label fw-semobold fs-6">{{translate('chooseunit')}}</label>
              <Field
                as="select"
                name="country"
                class="form-select form-select-solid form-select-lg fw-semobold chooseunit"
                :class="lang ==='enrtl' && 'chooseunit1'"
                v-model="unit_id"
                :options="showUnits"
              >
              <template v-for="(units) in showUnits" :key="units">
                <option :value="units.id">{{ units.building_name }}</option>
              </template>
                
              </Field>
        </div>
        <div class="col-lg-4 fv-row">
        <label class="col-lg-4 col-form-label fw-semobold fs-6">{{translate('offices')}}</label>
     
              <Field
                as="select"
                name="country"
                class="form-select form-select-solid form-select-lg fw-semobold officeslist"
                :class="lang ==='enrtl' && 'officeslist1'"
                v-model="office_id"
                :options="offices"
               
              >
              <template v-for="(office) in offices" :key="office">
                <option :value="office.id">{{ office.property_list }}</option>
              </template>
              <!-- :style="lang!=='ar' && {'margin-top' :'20px'}"  -->
              </Field>
        </div>
        <div class="col-lg-4 fv-row">
        <label class="col-lg-4 col-form-label fw-semobold fs-6">{{translate('selectcontractor')}}</label>
              <Field
                as="select"
                name="country"
                class="form-select form-select-solid form-select-lg fw-semobold selectcontractor"
                :class="lang ==='enrtl' && 'selectcontractor1'"
                v-model="company_id"
                :options="compaines"
                value-field="id"
                text-field="company_name"
              >
              <template v-for="(company) in compaines" :key="company">
                        <option :value="company.id">{{ company.company_name }}</option>
                      </template>
              </Field>
        </div>
        
    </div>
    <div >
     
      <div class="table-responsive">
        <!--begin::Table-->
        <table
          class="table align-middle table-row-dashed fs-6 fw-semobold gy-4"
          id="kt_subscription_products_table"
        >
          <!--begin::Table head-->
          <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
              <th  v-for="field in fields" :key='field.key'  > 
            {{field.label}} <i class="bi bi-sort-alpha-down" aria-label='Sort Icon'></i>
             </th>
            </tr>
          </thead>
          <!--end::Table head-->

          <!--begin::Table body-->
          <tbody class="text-gray-600">
            <tr v-for="item in items" :key='item'>
               <td v-for="field in fields" :key='field.key'><span v-if="field.key === 'no_of_people'">{{ officeslist && officeslist.no_of_people }}</span>
              <span v-else>{{item[field.key]}}</span></td>
            </tr>
          </tbody>
          <!--end::Table body-->
        </table>
        <!--end::Table-->
      </div>
    </div>
      
    </div>
  </div>
  <div v-for="(item, index) in selectform.questions" :key="`item${index}`">
        <div class="card h-100 mt-5">
      <!--begin::Card body-->
      <div class="card-body d-flex justify-content-center text-center flex-column p-8">
        <div class="d-flex flex-grow-1 min-width-zero">
          <div
            class="
              card-body
              align-self-center
              d-flex
              flex-column flex-md-row 
              justify-content-between
              min-width-zero
              align-items-md-center
            "
            style="padding-left: 0px"
          >
            <div class="list-item-heading mb-0 truncate mb-1 mt-1">
              <span class="heading-number d-inline-block">{{ index + 1 }}</span
              > {{lang === 'ar' ? item.question : item.question_en }}
            </div>
            <!-- <span v-if="errorindex==item.id">asdasd</span> -->
          </div>
        </div>
            <Field
              type="text"
                name="choose"
                class="form-control form-control-lg form-control-solid"
                :placeholder="lang==='ar' ?' ضع اجابتك هنا ': 'Put your answer here'"
                v-model="item.choose"
                v-if="item.answerType == '0'"
              />

              <div class="d-flex align-items-center" v-else-if="item.answerType == '2'"  v-for="(value, index) in item.answers" :key="index">
                  <!--begin::Checkbox-->
                  <input class="form-check-input" type="checkbox" :value="value.value" :name="`checkanswer${index}`" :id="`flexCheckDefault${index}`"  v-model="item.choose">
               <label class="form-check-label m-2" :for="`flexCheckDefault${index}`">{{lang === 'ar' ? value.label : value.label_en}}</label>
                    <!-- <input
                      v-model="item.choose"
                      class="form-check-input h-20px w-20px"
                      type="checkbox"
                      name="communication"
                      value-field="value.value"
                      text-field="value.label"
                    /> -->

                  </div>
                  <div class=" form-check form-check-custom form-check-solid pr-3"  v-else-if="item.answerType == '1'" >
              <!--begin::Option-->
                   <div v-for="(value, i) in item.answers" :key="i">
                  
                      <input
                      v-model="item.choose"
                      class="form-check-input m-2"
                      type="radio"
                      :name="`answer${index}`"
                      :value="value.value"
                      :id="`flexRadio${index}`"
                    />
                  <label class="form-check-label m-2" :for="`flexRadio${index}`">
                      {{lang === 'ar' ? value.label : value.label_en}}
                  </label>
                </div>
              </div>
              <div class="mt-3">
                <label class="col-lg-12 col-form-label fw-semobold fs-6 text-start">{{translate('comments')}}</label>
                <div class = "input-group">
              <!-- <span class="input-group-text">{{translate('comments')}}</span>  ] -->
                  <textarea
              class="form-control form-control-solid rounded-3"
              rows="3"
              max-rows="6"
              v-model="item.notes"
            ></textarea></div>
            <div class="row">
            <div class="col-6">
              <label class="col-lg-12 col-form-label fw-semobold fs-6 text-start">{{translate('uploadfile')}}</label>
              <div class = "input-group">
              <!-- <span class="input-group-text">{{translate('uploadfile')}}</span> -->
              <Field
                type="file"
                name="image"
                class="form-control form-control-lg form-control-solid"
                placeholder="Company website"
                v-model="item.image"
                ref="file"
                @change="getpath($event, item.id)"
              /></div>
            </div>
            
            </div>
              </div>
                
      </div>
      <!--end::Card body-->
    </div>
        </div>
        <div class="card mt-5 pt-5">
        <div class="card-body ">
        <div style="font-size: 18px" class="row">
        <div class="col-6">
              <label class="col-lg-12 col-form-label fw-semobold fs-6 text-start">{{translate('assignto')}}</label>  
             <div class = "input-group">
              <!-- <span class="input-group-text">{{ translate("assignto") }}</span> v-model="item.operation_id"-->
              <select
               name="status"
                class="form-select form-select-solid form-select-lg fw-semobold"
                :options="showusers"
                   v-model = "operation_id"
                > 
                      <template v-for="(status) in showusers" :key="status">
                        <option :value="status.id">{{ status.fullName }}</option>
                      </template>
              
              </select></div>
                
              
            </div>

        <div class="col-xs-6 col-sm-6 col-md-6 text-end mt-5">
        <button id="checktype" class="btn btn-primary" @click="saveanswer" >
            {{translate('save')}}
        </button>
      </div></div>
    </div>
  </div>

</template>
  
  <script lang="ts">
  import ApiService from "@/core/services/ApiService";
import { defineComponent, onMounted, ref ,watch} from "vue";
import KTDatatable from "@/components/kt-datatable/KTDataTable.vue";

import { ErrorMessage, Field, Form as VForm } from "vee-validate";
import router from "@/router";
import Swal from "sweetalert2";
import { string } from "yup";
import Questions from "@/components/devs/Questions.vue";
import { useI18n } from "vue-i18n";
  //import Notice from "@/components/Notice.vue";
  
  interface selectform {
  category: string;
  date: string;
  detail: string;
  id: string;
  questions: questions[];
  title:string;
  user_id:string;
}

interface questions{
  answerType:string,
   answers:answers[],
   choose:null,
   id:number,
   image ?:[] | null,
   notes?:string | null | any,
  //  operation_id:string,
   question:string
   question_en:string
   answer_detail_id:string;
}
 
interface showUnits {
        id:string | number|any;
        unit_number:string|any;
        unit_type:string|any;
        client_id:number|any;
        client_name:string|any;
        building_number:string | number|any;
        permissions:string|any;
        pilgrims:string|any;
        nationality:string|any;
        company:string|any;
        image:string |any;
}

interface compaines{
    id:number |any;
    company_name:string |any;
}

interface answers{
    value:string |any;
    label:string |any;
    label_en:string |any;
}
  export default defineComponent({
    name: "editlist",
    props: ['id', 'template_id'],
    components: {
      //Notice,
      Field,
      KTDatatable,
    },
    setup(props) {

      const { t, te } = useI18n();
        const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        }; 

        const fields= ref([
        // { key: "building_number", label: translate('buildingno') },
        // { key: "building_name", label: translate('buildingname') },
        { key: "userfirstname", label: translate('owner') },
        { key: "representative", label: translate('representative') },
        { key: "permissions", label: translate('permitno') },
        { key: "company", label: translate('contractor') },
        { key: "unit_type", label: translate('typeunit') },
        // { key: "nationality", label: translate('nationality') },
        // { key: "pilgrims", label: translate('noofpilgrims') },
        // { key: "unit_number", label: translate('unitno') },
        // { key: "company", label: translate('undertaker') },
        { key: "no_of_people", label: translate('noofpeople') },
      ]);
    
      const showusers = ref<any>([]);
      const title= ref('');
      const notifications=ref('');
      const showUnits = ref<showUnits>({
        id:0,
        unit_number:"",
        unit_type:"",
        client_id:0,
        client_name:"",
        building_number:"",
        permissions:"",
        pilgrims:"",
        nationality:"",
        company:"",
        image:"",
      });
      const errorindex= ref<any>("");
      const items=ref([]);
      const loaded= ref<Boolean>(false);
      const compaines= ref<compaines>({
        id:0,
        company_name:"",
      });
      const asnwer_id= ref("");
      const company_id=ref("");
      const office_id=ref("");
      const operation_id=ref("");
      const user_id = localStorage.getItem('logged_user_id')  as string;
      const lang = localStorage.getItem('lang');
      const unit_id= ref("");
      const office=ref("");
      const image= ref("");
      const offices= ref<any>([]);
        const officeslist= ref<any>([]);
      const selectform = ref<selectform>({
        category: "",
        date: "",
        detail: "",
        id: "",
        questions:[{
          answerType:"",
            answers:[],
            choose:null,
            id:0,
            image:[],
            notes:null,
            // operation_id:"",
            question:"",
            question_en:"",
            answer_detail_id:''
        }],
        title:"",
        user_id:"",
      });

      // const questions = ref<questions>({
      //   answerType:"",
      //       answers:[],
      //       choose:null,
      //       id:0,
      //       image:[],
      //       notes:null,
      //       operation_id:"",
      //       question:""
      // })
     const asnwers= ref<answers>();
     const asnwer= ref<any>("");
        // const data = ref(props.data);
        // const selectedItems = ref([props.selectedItems]);

        watch(unit_id, (currentValue, oldValue) => {
             console.log('on client change');
            ApiService.get(`showUnit/${currentValue}`)
            .then(({ data }) => {
              console.log('units datat',data )
                items.value = data.data;
            })
            .catch(({ response }) => {
            });
          
            ApiService.get(`showClients/${currentValue}`)
            .then(({ data }) => {
                showusers.value = data.data.map((user)=>{
                    return {
                    fullName: `${user.firstname} ${user.lastname}`,
                    id: user.id,
                    };
                });
            })
            .catch(({ response }) => {
            });

            ApiService.post("showRegisteredPropertyunitid",{id:currentValue, user_id:user_id})
           // ApiService.post(`showRegisteredPropertyunitid/`, {id:currentValue, user_id:user_id})
            .then(({ data }) => {
                if(data.length === 0){
                  offices.value=[];
              office_id.value="";  
             }else{
              ApiService.post("showRegisteredFieldId",{id:data[0].id}).then(({ data }) => {
                console.log('office data', data);
                offices.value = data;
                    })
                .catch(({ response }) => {
                });    
             }
            })
            .catch(({ response }) => {
            });
      });



      watch(office_id, (currentValue, oldValue) => {
             console.log('on office change', currentValue);
            ApiService.post("showRegisteredFieldbyId",{id:currentValue})
           // ApiService.post(`showRegisteredPropertyunitid/`, {id:currentValue, user_id:user_id})
            .then(({ data }) => {
                console.log('regissteredd', data[0]);
                officeslist.value = data[0];
            })
            .catch(({ response }) => {
            });
      });

        onMounted(() => {
            let id = props.id;
          
         ApiService.get(`show/${props.id}`)
            .then(({ data }) => {
                selectform.value = data;
                title.value = data.title;
                // console.log('props.template_id', props.template_id);
                let template_id= props.template_id
              if(props.template_id)
              {    asnwer_id.value= template_id;
                var el: HTMLElement | any = document.getElementById('checktype');
                el.innerText = translate('amendment');
              // document.getElementById('checktype').innerText="تعديل"
              ApiService.get(`/showAnswerDetail/`+ props.template_id)
                .then(({ data }) => {
                   console.log('answerdetails', data);
                    unit_id.value = data[0].unit_id;
                    company_id.value = data[0].company_id;
                    office_id.value = data[0].office_id;
                    operation_id.value = data[0].TaskUserid;
                    for (var i = 0; i < selectform.value.questions.length; i++) {
                  for (var k = 0; k < data.length; k++) {
                    if (selectform.value.questions[i].id == data[k].question_id)
                    {
                      console.log('datak', data[k])
                      selectform.value.questions[i].answerType!="2"?selectform.value.questions[i].choose=data[k].answers.toString():selectform.value.questions[i].choose=data[k].answers
                      selectform.value.questions[i].notes=data[k].notes
                      // selectform.value.questions[i].operation_id=data[k].TaskUserid
                      selectform.value.questions[i].answer_detail_id = data[k].answer_detail_id
                    }
                  }
                }
                })
                .catch(({ response }) => {
                });

              }
            })
            .catch(({ response }) => {
            });

                ApiService.get("showUnits")
                .then(({ data }) => {
                    showUnits.value = data.data;
                })
                .catch(({ response }) => {
                });

            ApiService.get("showCompanies")
            .then(({ data }) => {
                compaines.value = data.data;
            })
            .catch(({ response }) => {
            });
      });
       
      const getpath=(e, w)=> {
      selectform.value.questions.forEach((item, index) => {
        if (item.id == w) {
          item.image = e.target.files[0];
        }
      });
    }

      const  saveanswer= (e) =>{
    //   alert("asd")
      for (let v = 0; v < selectform.value.questions.length; v++) {
        if (selectform.value.questions[v].choose == "") {
          errorindex.value = selectform.value.questions[v].id;
          //  return;
        }
      }
      let userid = localStorage.getItem("logged_user_id") as string;
      let data = new FormData;
      data.append("category", selectform.value.category);
      data.append("date", selectform.value.date);
      data.append("detail", selectform.value.detail);
      data.append("id", selectform.value.id);
      data.append("title", selectform.value.title);
      data.append("unit_id", unit_id.value);
      data.append("company_id", company_id.value);
      data.append("office_id", office_id.value);
      data.append("operation_id", operation_id.value);
      // const array = [];
      data.append("user_id", userid);
    
      for (var i = 0; i < selectform.value.questions.length; i++) {
        let answerType = selectform.value.questions[i].answerType;
        let choose = selectform.value.questions[i].choose;
        let id = selectform.value.questions[i].id;
        let image = selectform.value.questions[i].image;
        let notes = selectform.value.questions[i].notes;
        let question = selectform.value.questions[i].question;
        let answers = selectform.value.questions[i].answers;
        // let operation_id = selectform.value.questions[i].operation_id;
        let answer_detail_id = selectform.value.questions[i].answer_detail_id; 
       
        //  let a1 = {answerType:answerType,
        // choose:choose,
        // operation_id:operation_id,
        // id:id,
        // image:image,
        // notes:notes,
        // question:question,
        // answers:answers};
        console.log('editdata', selectform.value.questions[i]);
        data.append("questions[" + i + "][answerType]", answerType);
        data.append("questions[" + i + "][choose]", choose ? choose : "");
        // data.append("questions[" + i + "][operation_id]", operation_id);
        data.append("questions[" + i + "][id]", id as any);
        data.append("questions[" + i + "][image]", image as any);
        data.append("questions[" + i + "][notes]", notes as any);
        data.append("questions[" + i + "][question]", question);
        data.append("questions[" + i + "][answers]", answers as any);
        if(selectform.value.questions[i].answer_detail_id !=""){
          data.append("questions[" + i + "][answers_id]", answer_detail_id as any);
        }
        // array.push(a1);
      }
      //data.append("questions",array);
      // data = {
      //   category:selectform.value.category,
      //   date:selectform.value.date,
      //   detail: selectform.value.detail,
      //   id: selectform.value.id,
      //   title: selectform.value.title,
      //   unit_id: unit_id.value,
      //   company_id: company_id.value,
      //   user_id: userid,
      //   questions : array,
      //   answer_id:asnwer_id.value,
      //   _method:'PUT'
      // }
      console.log('operation_id', operation_id.value);
      for (const value of data.values()) {
              console.log(value);
            }
    
    var el: HTMLElement | any = document.getElementById('checktype');
      if(el.innerText==translate('amendment'))
      { 
         //eturn;
        data.append('answer_id',asnwer_id.value)
              data.append('_method', 'PUT')
              ApiService.post("updateAnswer/"+ asnwer_id.value, data)
              
            .then(({ data }) => {
                setTimeout(() => {
                    Swal.fire({
                    text: translate('savedsuccess'),
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText:  translate('okgotit'),
                    heightAuto: false,
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                    }).then(() => {
                    router.push({ name: "SurveyList" });
                    });
                }, 2000);
            })
            .catch(({ response }) => {
            });
        }else{
          // return;
            ApiService.post("addAnswer", data)
              
            .then(({ data }) => {
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
                    router.push({ name: "SurveyList" });
                    });
                }, 2000);
            })
            .catch(({ response }) => {
            });
        }

    };

      return {
        selectform,
        title,
        asnwer_id,
        compaines,
        showUnits,
        saveanswer,
        unit_id,
        company_id,
        office_id,
        showusers,
        items,
        fields,
        translate,
        getpath,
        operation_id,
        offices,
        office,
        lang,
        officeslist
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
</style>
  