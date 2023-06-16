<template>
    <div class="card">
      <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
          {{ title }}
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
          <!--begin::Toolbar-->
          
          <!--end::Toolbar-->
          <!--begin::Group actions-->
         
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
      <!-- <div v-for="table in tableData">
        <h1>{{ table.company_name }}</h1>
      </div> -->
      
      <div class="card-body pt-0">
        <Datatable
         
          :data="tableData"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
          :checkbox-enabled="true"
          checkbox-label="id"
        >
        <template v-slot:id="{ row: table }">
            {{ table.id}}
          </template>
          <template v-slot:Date="{ row: table }">
              {{ table.Date }}
          </template>
          <template v-slot:detail="{ row: table }">
              {{ table.detail }}
          </template>
          <template v-slot:question="{ row: table }">
              {{ table.question }}
          </template>
          <template v-slot:status="{ row: table }">
              {{ table.status }}
          </template>
          <template v-slot:assign_user_id="{ row: table }">
              {{ table.assign_user_id }}
          </template>
        </Datatable>
      </div>
    </div>
    <ContractorAddNewModal :items="tableData"></ContractorAddNewModal>
    <ExportCustomerModal></ExportCustomerModal>
    <AddCustomerModal></AddCustomerModal>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted, watch } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
  import ExportCustomerModal from "@/components/modals/forms/ExportCustomerModal.vue";
  import AddCustomerModal from "@/components/modals/forms/AddCustomerModal.vue";
  import ContractorAddNewModal from "@/containers/applications/ContractorAddNewModal.vue";

import ApiService from "@/core/services/ApiService";
import { useI18n } from "vue-i18n";

 interface items{
    id:number;
    company_name:string;
 }

  export default defineComponent({
    name: "notcompletedtaskq",
    props:['cat'],
    components: {
      Datatable,
      ExportCustomerModal,
      AddCustomerModal,
      ContractorAddNewModal,
    },
    setup(props) {
      const tableHeader = ref([
        {
          columnName: "thedate",
          columnLabel: "Date",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName:  'thedetails',
          columnLabel: "detail",
          sortEnabled: true,
          columnWidth: 230,
        },
        {
          columnName: "themission",
          columnLabel: "question",
          sortEnabled: true,
          columnWidth: 230,
        },
        {
          columnName: "thecondition",
          columnLabel: "status",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "unitadministrator",
          columnLabel: "assign_user_id",
          sortEnabled: true,
          columnWidth: 175,
        },
      ]);
      const { t, te } = useI18n();
      const selectedIds = ref<Array<number>>([]);
      const title=ref<String>('');
      const tableData = ref<Array<items>>([]);

        const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        };

        onMounted(() => {

        if(props.cat === "em"){
          title.value=translate('rejectemtask');
         ApiService.get("taskemNotDone")
      .then(({ data }) => {
        tableData.value = data;
      
      });
    }else{

      title.value=translate('rejecthrtask');
        ApiService.get("taskHrnotDone")
      .then(({ data }) => {
        tableData.value = data;
 
      });
    }
     
      });

      watch(props, (toParams, previousParams) => {
        if(toParams.cat === 'em'){
   
          title.value=translate('rejectemtask');

         ApiService.get("taskemNotDone")
      .then(({ data }) => {
        tableData.value = data;
        
      });
    }else{
      title.value=translate('rejecthrtask');
        ApiService.get("taskHrnotDone")
      .then(({ data }) => {
        tableData.value = data;
        
      });
    }
})
  
      return {
        tableData,
        tableHeader,
        selectedIds,
        title,
      };
    },
  });
  </script>
  