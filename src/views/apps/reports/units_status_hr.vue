<template>
    <div class="card mb-8">
      <!-- <div class="card-header border-0 pt-6"></div> -->
      <div class="card-body ">
        <div class="row">
          <div class="col-md-3">
            <Field
                type="text"
                class="form-control form-control-solid"
                name="firstName"
                v-model="template_name" 
                :placeholder="translate('searchbymodelname')"
              />
          </div>
          <div class="col-md-3">
            <Field
                type="text"
                class="form-control form-control-solid"
                name="firstName"
                v-model="unit_number" 
                :placeholder="translate('searchbyunitno')"
              />
          </div>
          <div class="col-md-3">
            <Field
                type="text"
                class="form-control form-control-solid"
                name="firstName"
                v-model="client_name" 
                :placeholder="translate('searchbyinsname')"
              />
          </div>
          <div class="col-md-3 text-center">
            <button class="btn btn-primary" @click="searchresults">{{translate("search")}}</button>
          </div>
        </div>
      </div> 
    </div>
    <div class="card">
      <div class="card-body pt-6">
        <Datatable
           @on-sort="sort"
          :data="items"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
        >
        <template v-slot:Template_Title="{ row: customer }">
            {{ customer.Template_Title}}
          </template>
          <template v-slot:Template_Detail="{ row: customer }">
            {{ customer.Template_Detail}}
          </template>
          <template v-slot:unit_number="{ row: customer }">
              {{ customer.unit_number }}
          </template>
          <template v-slot:nationality="{ row: customer }">
              {{ customer.nationality }}
          </template>
          <template v-slot:pilgrims="{ row: customer }">
              {{ customer.pilgrims }}
          </template>
          <template v-slot:SuccessPercentage="{ row: customer }">
              {{ customer.SuccessPercentage }}
          </template>
          <template v-slot:FailedPercentage="{ row: customer }">
              {{ customer.FailedPercentage }}
          </template>
          <template v-slot:actions="{ row: customer }">
            <button
            @click="gotopage(customer.answer_id)"
            class="btn btn-sm btn-light btn-active-light-primary"
            >{{translate('details')}}
          </button>
          </template>
          <template v-slot:print="{ row: customer }">
            <button
          @click="gotoprint(customer.answer_id)"
            class="btn btn-sm btn-light btn-active-light-primary"
            >{{translate('print')}}
          </button>
          </template>
        </Datatable>
      </div>
    </div>
  
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import Dropdown3 from "@/components/dropdown/Dropdown3.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
  import ApiService from "@/core/services/ApiService";
  import customers from "@/core/data/customers";
  import type { ICustomer } from "@/core/data/customers";
  import { adminRoot } from "@/components/constants/config";
  import router from "@/router";
  import { ErrorMessage, Field, Form as VForm } from "vee-validate";
  import arraySort from "array-sort";
import { useI18n } from "vue-i18n";
  //  interface surveydata{
  //     answers_count: number;
  // category : string;
  // date: string;
  // detail: string;
  // id:number;
  // questions: [];
  // title: string;
  //  }
  
  export default defineComponent({
    name: "units_status_hr",
    props:['id','template_id'],
    components: {
      Datatable,
      Field,
    },
    setup(props) {
        const tableHeader = ref([
        {
          columnName:  "sample",
          columnLabel: 'Template_Title',
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "formdetails",
          columnLabel: 'Template_Detail',  
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "unitno",
          columnLabel: 'unit_number', 
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "nationality",
          columnLabel: 'nationality',
          sortEnabled: true,
          columnWidth:150,
        },
        {
          columnName: "noofpilgrims",
          columnLabel: 'pilgrims',
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "successrate",
          columnLabel: 'SuccessPercentage', 
          sortEnabled: true,
          columnWidth:150,
        },
        {
          columnName:  'mistakepercentage',
          columnLabel: 'FailedPercentage',
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "theevent",
          columnLabel: 'actions', 
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "printing",
          columnLabel: "print",
          sortEnabled: true,
          columnWidth: 150,
        },
        
      ]);
      const tableData = ref<Array<ICustomer>>(customers);
    
      const selectedIds = ref<Array<number>>([]);
      const title=ref<String>('');
        const detail=ref<String>('');
      const items = ref<Array<string>>([]);
        const currentPage=ref(1);
        const totalRows=ref(0);
        const perPage = ref(0);
        const sortDesc=ref<boolean>(true);
        const  client_name=ref<String>('');
        const unit_number=ref<String>('');
        const  template_name=ref<String>('');
  
        const { t, te } = useI18n();
        const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        }; 
        // const apiBase=ref(`${setHeaderAuth()}/units_status`);
        onMounted(() => {
          if(props.id!=null)
        {
          ApiService.get(`companyForms/${props.id}?page=${currentPage.value}&sortDesc=${sortDesc.value}`)
       .then(({ data }) => {
           items.value=data.data;
           totalRows.value = data.Count
            perPage.value = 15
      
        }); 
        }
        else if (props.template_id!=null)
        {
          ApiService.get(`templateForms/${props.template_id}?page=${currentPage.value}&sortDesc=${sortDesc.value}`).then(({ data }) =>
        {
           items.value=data.data;
            totalRows.value = data.Count
            perPage.value = 15
        })
  
        }
        else
        {
          ApiService.get(`units_status/hr?page=${currentPage.value}&sortDesc=${sortDesc.value}`).then(({ data }) =>{
          items.value=data.data;
           totalRows.value = data.Count
            perPage.value = 15
        })
  
        }
         
         
        });
  
        const searchresults = () =>{
          ApiService.get(`units_status/hr?page=${currentPage.value}&sortDesc=${sortDesc.value}&template_name=${template_name.value}&client_name=${client_name.value}&unit_number=${unit_number.value}`).then((data)=>
        {
          items.value=data.data;
           totalRows.value = data.data.Count
         perPage.value = 15
        })
        }
      
        const sort = (sort: Sort) => {
        const reverse: boolean = sort.order === "asc";
        if (sort.label) {
          arraySort(tableData.value, sort.label, { reverse });
        }
      };
  
        const gotopage=(answer_id)=>
         {
            router.push({ name: 'success',params:{id:answer_id}});
         }
         const getimage = (e) =>
         {
  
         }
         const gotoprint = (answer_id) =>
         {
         window.open(`https://forms.innovativeideasbox.com/API/api/print/${answer_id}`, '_blank');
         }
  
      return {
        items,
        tableHeader,
        selectedIds,
        title,
        detail,
        tableData,
        gotopage,
        gotoprint,
        client_name,
        unit_number,
        template_name,
        searchresults,
        sort,
        translate
      };
    },
  });
  </script>
  