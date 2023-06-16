<template>
   <div class="card">
      <!--  <div class="card-header border-0 pt-6">
      begin::Card title-->
        <!-- <div class="card-title"> -->
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
        <!-- </div> -->
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <!-- <div class="card-toolbar"> -->
          <!--begin::Toolbar-->
          <!-- <div
            v-if="selectedIds.length === 0"
            class="d-flex justify-content-end"
            data-kt-customer-table-toolbar="base"
          > -->
            <!--begin::Export-->
            <!-- <button
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
            <!-- <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#kt_modal_add_customer"
            >
              <span class="svg-icon svg-icon-2">
                <inline-svg src="/media/icons/duotune/arrows/arr075.svg" />
              </span>
              Add Customer
            </button> -->
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
          <!-- <div
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
         =end::Group actions
        </div>
       -end::Card toolbar--
      </div> -->
      <!-- <div v-for="n in suerveydata" :key="n">
         <h5>{{ n }}</h5>
      </div> -->
      <!-- <div class="card-body pt-0" v-for="(item,index) in suerveydata" :key="`item${index}`"> -->
      <div class="card-body pt-0" >
        <!-- <h5>{{ item.id }}</h5> -->
        <Datatable
          :data="suerveydata"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
          
        >
          <template v-slot:title="{ row: table }">
            <router-link  :to="{
           name:'editlist',
            params: {
              id: table.id
            }
           }"
           class="text-gray-600 text-hover-primary mb-1" >
            {{ table.title}}
            </router-link>
          </template>
          <template v-slot:detail="{ row: table }">
              {{ table.detail }}
          </template>
          <template v-slot:inspectiontype="{ row: table }" >
            <span v-for="ins in inspectiontypes" :key="ins" v-if="inspectiontypes !== '' && inspectiontypes.length > 0 "
            ><span  v-if="ins.id== table.inspectiontype && lang=='en'||lang == 'enrtl'"> {{ ins.name_en }}</span> 
            <span  v-if="ins.id== table.inspectiontype && lang=='ar'"> {{ ins.name_ar  }}</span></span>
            <span v-else></span>
          </template>
          <template v-slot:date="{ row: table }">
              {{ table.date }}
          </template>
        </Datatable>
        
        <!-- <SurveyListItem
        :key="item.id"
        :data="item"
        :selected-items="selectedItems"
        @toggle-item="toggleItem"
      
        ></SurveyListItem> -->
      </div>
    </div>
  
    <!-- <ExportCustomerModal></ExportCustomerModal>
    <AddCustomerModal></AddCustomerModal> -->
  </template>
  
  <script lang="ts">
  import { defineComponent, ref , onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
  import ExportCustomerModal from "@/components/modals/forms/ExportCustomerModal.vue";
  import AddCustomerModal from "@/components/modals/forms/AddCustomerModal.vue";
  import customers from "@/core/data/customers";
  import type { ICustomer } from "@/core/data/customers";
  import arraySort from "array-sort";
import ApiService from "@/core/services/ApiService";
import SurveyListItem from "@/components/SurveyApp/SurveyListItem2.vue";
import { useSurveyStore } from "@/stores/survey";
interface surveydata{
    answers_count: number;
category : string;
date: string;
detail: string;
id:number;
questions: [];
title: string;
 }
  export default defineComponent({
    name: "SurveyList",
    components: {
      Datatable,
      ExportCustomerModal,
      AddCustomerModal,
      SurveyListItem,
    },
    setup() {
      const tableHeader = ref([
        {
          columnName: "title",
          columnLabel: "title",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: 'thedetails',
          columnLabel: "detail",
          sortEnabled: true,
          columnWidth: 230,
        },
        {
          columnName: "inspectiontype",
          columnLabel: "inspectiontype",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "thedate",
          columnLabel: "date",
          sortEnabled: true,
          columnWidth: 230,
        },
        
      ]);
       const sortOptions= ref([
        {
          column: "title",
          label: "Title"
        },
        {
          column: "category",
          label: "Category"
        },
        {
          column: "label",
          label: "Label"
        },
        {
          column: "status",
          label: "Status"
        }
      ]);
      
      const categories= ref([
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
      const statuses=ref([
        {
          text: "ACTIVE",
          value: "ACTIVE"
        },
        {
          text: "COMPLETED",
          value: "COMPLETED"
        }
      ]);
      const suerveydata = ref<Array<surveydata>>([]);
      const islodaing= ref<Boolean>(true);
      const selectedIds = ref<Array<number>>([]);
        const inspectiontypes = ref<any>([]);
      const selectedItems= ref<Array<number>>([]);
    const store = useSurveyStore();
       const lang = localStorage.getItem('lang');
      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
         ApiService.get('show')
      .then(({ data }) => {
        console.log('show', data)
        suerveydata.value = data.data;
      })
      .catch(({ response }) => {
        
      });

      ApiService.get('showAllInspectionTypes')
      .then(({ data }) => {
        console.log('showAllInspectionTypes', data)
        inspectiontypes.value = data;
      })
      .catch(({ response }) => {
        
      });

      });

      const getIndex = (value, arr, prop) => {
      for (var i = 0; i < arr.length; i++) {
        if (arr[i][prop] === value) {
          return i;
        }
      }
      return -1;
    };

    //  const toggleItem=(event, itemId) =>{
    //   if (event.shiftKey && selectedItems.value.length > 0) {
    //     let itemsForToggle = store.surveyItems;
    //     var start = getIndex(itemId, itemsForToggle, "id");
    //     var end = getIndex(
    //       selectedItems[selectedItems.value.length - 1],
    //       itemsForToggle,
    //       "id"
    //     );
    //     itemsForToggle = itemsForToggle.slice(
    //       Math.min(start, end),
    //       Math.max(start, end) + 1
    //     );
    //     selectedItems.value.push(
    //       ...itemsForToggle.map(item => {
    //         return item.id;
    //       })
    //     );
    //   } else {
    //     if (selectedItems.value.includes(itemId)) {
    //       selectedItems.value = selectedItems.value.filter(x => x !== itemId);
    //     } else {
    //       selectedItems.value.push(itemId);
    //     }
    //   }
    // };
  
    
      const onItemSelect = (selectedItems: Array<number>) => {
        selectedIds.value = selectedItems;
      };
  
      return {
        suerveydata,
        selectedItems,
        // toggleItem,
        selectedIds,
        onItemSelect,
        tableHeader,
        inspectiontypes,
        lang
      };
    },
  });
  </script>
  