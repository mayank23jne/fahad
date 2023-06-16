<template>
    <div class="card">
        <div class="card-header border-0 pt-6">
      <!--begin::Card title-->
      <div class="card-title">
        <!--begin::Search-->
        <!-- <div class="d-flex align-items-center position-relative my-1">
          <span class="svg-icon svg-icon-1 position-absolute ms-6">
            <inline-svg src="/media/icons/duotune/general/gen021.svg" />
          </span>
          <input
            type="text"
            v-model="search"
            @input="searchItems()"
            class="form-control form-control-solid w-250px ps-15"
            placeholder="Search Customers"
          />
        </div> -->
        <!--end::Search-->
      </div>
      <!--begin::Card title-->
      <!--begin::Card toolbar-->
      <div class="card-toolbar">
        <!--begin::Toolbar-->
        <!-- <div
          v-if="selectedIds.length === 0"
          class="d-flex justify-content-end"
          data-kt-customer-table-toolbar="base"
        >
        
          <button
            type="button"
            class="btn btn-light-primary me-3"
            data-bs-toggle="modal"
            data-bs-target="#kt_customers_export_modal"
          >
            <span class="svg-icon svg-icon-2">
              <inline-svg src="/media/icons/duotune/arrows/arr078.svg" />
            </span>
            Export
          </button> -->
          <!--end::Export-->
          <!--begin::Add customer-->
          <button
            type="button"
            class="btn btn-primary"
            @click="print">
            {{translate('print')}}
          </button>
          <!--end::Add customer-->
        <!-- </div> -->
        <!--end::Toolbar-->
        <!--begin::Group actions-->
        <!-- <div
          v-else
          class="d-flex justify-content-end align-items-center"
          data-kt-customer-table-toolbar="selected"
        >
          <div class="fw-bold me-5">
            <span class="me-2">{{ selectedIds.length }}</span
            >Selected
          </div>
          <button
            type="button"
            class="btn btn-danger"
            @click="deleteFewCustomers()"
          >
            Delete Selected
          </button>
        </div> -->
        <!--end::Group actions-->
        <!--begin::Group actions-->
        <div
          class="d-flex justify-content-end align-items-center d-none"
          data-kt-customer-table-toolbar="selected"
        >
          <div class="fw-bold me-5">
            <span
              class="me-2"
              data-kt-customer-table-select="selected_count"
            ></span
            >Selected
          </div>
          <button
            type="button"
            class="btn btn-danger"
            data-kt-customer-table-select="delete_selected"
          >
            Delete Selected
          </button>
        </div>
        <!--end::Group actions-->
      </div>
      <!--end::Card toolbar-->
    </div>
      
      <div class="card-body pt-0">
        <Datatable
          :data="items"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
          :checkbox-enabled="true"
          checkbox-label="id"
        >
        <template v-slot:Date="{ row: customer }">
            {{ customer.Date}}
          </template>
          <template v-slot:unit="{ row: customer }">
            {{ customer.unit}}
          </template>
          <template v-slot:question="{ row: customer }">
              {{ customer.question }}
          </template>
          <template v-slot:answer="{ row: customer }">
              {{ customer.answer }}
          </template>
          <template v-slot:user="{ row: customer }">
              {{ customer.user }}
          </template>
          <template v-slot:image="{ row: customer }">
            <div>
                <center>
                <button
               
                data-target="#modalShow">

                <img v-if="customer.image==''"
               
                src="https://www.w3schools.com/images/lamp.jpg"
                @click="onImageClick(customer.image)"
                    />
                <img v-else
                style=" width: 50px; height: 50px; "
                
                :src="'https://forms.innovativeideasbox.com/API/public/uploads/' + customer.image"
                :class="getImageClass(customer.id)"
                @click="onImageClick('https://forms.innovativeideasbox.com/API/public/uploads/' + customer.image)"
                    />
                </button>
                </center>
            </div>
          </template>
          <template v-slot:unit_number="{ row: customer }">
              {{ customer.unit_number }}
          </template>
         
          <template v-slot:notes="{ row: customer }">
              {{ customer.notes }}
          </template>
          <template v-slot:TaskImage="{ row: customer }">
            {{ customer.TaskImage }}
          </template>
          <template v-slot:TaskNote="{ row: customer }">
            {{ customer.TaskNote }}
          </template>
          <template v-slot:TaskStatus="{ row: customer }">
            {{ customer.TaskStatus }}
          </template>
          <template v-slot:TaskUser="{ row: customer }">
            {{ customer.TaskUser }}
          </template>
        </Datatable>
      </div>
    </div>
  
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
import Datatable from "@/components/kt-datatable/KTDataTable.vue";
import Dropdown3 from "@/components/dropdown/Dropdown3.vue";
 
import ApiService from "@/core/services/ApiService";
import customers from "@/core/data/customers";
import type { ICustomer } from "@/core/data/customers";
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
    name: "success",
    props:['id'],
    components: {
      Datatable,
      Dropdown3,
    },
    setup(props) {
        const tableHeader = ref([ 
        {
          columnName:  "thedate",
          columnLabel: 'Date',
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "unit",
          columnLabel: 'unit',  
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "thequestion",
          columnLabel: 'question', 
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "theanswers",
          columnLabel: 'answer',
          sortEnabled: true,
          columnWidth:150,
        },
        {
          columnName: "theuser",
          columnLabel: 'user',
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "attachments",
          columnLabel: 'image', 
          sortEnabled: true,
          columnWidth:150,
        },
        {
          columnName:   "comments",
          columnLabel: 'notes',
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "taskimage",
          columnLabel: 'TaskImage', 
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "tasknotes",
          columnLabel: "TaskNote",
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "taskstatus",
          columnLabel: "TaskStatus",
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "usertask",
          columnLabel: "TaskUser",
          sortEnabled: true,
          columnWidth: 150,
        },
      ]);
      const tableData = ref<Array<ICustomer>>(customers);
    
      const selectedIds = ref<Array<number>>([]);
      const title=ref<String>('');
        const detail=ref<String>('');
        const fullWidthImageIndex=ref('');
      const items = ref<Array<string>>([]);
        const  isadmin=ref<boolean>(false);

        const { t, te } = useI18n();
        const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        }; 


        onMounted(() => {
           let id = props.id;     
         ApiService.get(`showAnswerDetail/${id}`)
       .then(({ data }) => {
          items.value = data
        //   title.value = data.title;
        //   detail.value = data.detail;
        });  
        });


       const getImageClass=(i)=> {
        return {
            'fullWidthImage': fullWidthImageIndex.value === i
        };
    }

      const onImageClick=(i)=> {
        window.open(i,"_blank")
    }
    const print=()=>
    {
          let id = props.id;
        window.open(`https://forms.innovativeideasbox.com/API/api/print/${id}`, '_blank');
    }
      return {
        items,
        tableHeader,
        selectedIds,
        title,
        detail,
        tableData,
        print,
        getImageClass,
        onImageClick,
        translate
      };
    },
  });
  </script>
  