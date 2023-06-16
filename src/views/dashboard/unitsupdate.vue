<template>
    <div class="card pt-6">
      <!-- <div class="card-header border-0 "> -->
        <!--begin::Card title-->
        <!-- <div class="card-title"> -->
          
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
          </div> -->
          <!--end::Group actions-->
        <!-- </div> -->
        <!--end::Card toolbar-->
      <!-- </div> -->
      <!-- <div v-for="table in tableData">
        <h1>{{ table.company_name }}</h1>
      </div> -->
      
      <div class="card-body pt-0">
        <Datatable
          @on-sort="sort"
          @on-items-select="onItemSelect"
          :data="tableData"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
        
        >
          <template v-slot:building_number="{ row: table }">
            {{ table.building_number}}
          </template>
          <template v-slot:building_name="{ row: table }">
            {{ table.building_name}}
          </template>
          <template v-slot:representative="{ row: table }">
            {{ table.representative}}
          </template>
          <template v-slot:client_name="{ row: table }">
              {{ table.client_name }}
          </template>
          <template v-slot:permissions="{ row: table }">
              {{ table.permissions }}
          </template>
          <template v-slot:company="{ row: table }">
              {{ table.company }}
          </template>
          <template v-slot:unit_type="{ row: table }">
              {{ table.unit_type }}
          </template>
          <template v-slot:actions="{ row: table }" >
          <button
          @click="gotopage(table.id)"
            class="btn btn-sm btn-light btn-active-light-primary"
            >{{translate('details')}}
          </button>
        </template>
        
        </Datatable>
      </div>
    </div>
    <ContractorAddNewModal :items="tableData"></ContractorAddNewModal>

  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
  import ContractorAddNewModal from "@/containers/applications/ContractorAddNewModal.vue";
  import arraySort from "array-sort";
  import ApiService from "@/core/services/ApiService";
  import router from "@/router";
  import { useI18n } from "vue-i18n";

 interface items{
    building_number:number|string;
    client_id:string;
    client_name:string;
    company:string;
    id:number;
    image:null;
    nationality:string;
    permissions:number;
    unit_number:number|string;
    unit_type:string;
 }

  export default defineComponent({
    name: "unitsupdate",
    components: {
      Datatable,
      ContractorAddNewModal,
    },
    setup() {
      const { t, te } = useI18n();
      const tableHeader = ref([
        {
          columnName: "buildingno",
          columnLabel: "building_number",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "buildingname",
          columnLabel: "building_name",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "representative",
          columnLabel: "representative",
          sortEnabled: true,
          columnWidth: 200,
        },
        {
          columnName: "owner",
          columnLabel: "client_name",
          sortEnabled: true,
          columnWidth: 200,
        },
        {
          columnName:  "permitno",
          columnLabel: "permissions",
          sortEnabled: true,
          columnWidth: 200,
        },
        {
          columnName:  "contractor",
          columnLabel: "company",
          sortEnabled: true,
          columnWidth: 200,
        },
        {
          columnName: "typeunit" ,
          columnLabel: "unit_type",
          sortEnabled: true,
          columnWidth: 200,
        },
        {
          columnName: "events",
          columnLabel: "actions",
          sortEnabled: true,
          columnWidth: 170,
        },
        
      ]);
      const selectedIds = ref<Array<number>>([]);
  
      const tableData = ref<Array<items>>([]);
      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
         ApiService.get("showUnits")
      .then(({ data }) => {
        tableData.value = data.data;
         
      });
     
      });

     const gotopage=(e)=>
       {
        router.push({name: 'units', params: { id: e }})
       }
  
      const deleteFewCustomers = () => {
        selectedIds.value.forEach((item) => {
          deleteCustomer(item);
        });
        selectedIds.value.length = 0;
      };
  
      const deleteCustomer = (id: number) => {
        for (let i = 0; i < tableData.value.length; i++) {
          if (tableData.value[i].id === id) {
            tableData.value.splice(i, 1);
          }
        }
      };
  
      const search = ref<string>("");
      
      const sort = (sort: Sort) => {
        const reverse: boolean = sort.order === "asc";
        if (sort.label) {
          arraySort(tableData.value, sort.label, { reverse });
        }
      };
      const onItemSelect = (selectedItems: Array<number>) => {
        selectedIds.value = selectedItems;
      };

      const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };
  
      return {
        tableData,
        tableHeader,
        gotopage,
        deleteCustomer,
        search,
        selectedIds,
        deleteFewCustomers,
        sort,
        onItemSelect,
        translate
      };
    },
  });
  </script>
  