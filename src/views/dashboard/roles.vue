<template>
    <div class="card">
      <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
          
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
          <!--begin::Toolbar-->
          <div
            v-if="selectedIds.length === 0"
            class="d-flex justify-content-end"
            data-kt-customer-table-toolbar="base"
          >
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#kt_modal_add_roles"
            >
              <span class="svg-icon svg-icon-2">
                <inline-svg src="/media/icons/duotune/arrows/arr075.svg" />
              </span
              >{{ translate('adduserrole') }}
            </button>
            <!--end::Add customer-->
          </div>
          <!--end::Toolbar-->
          <!--begin::Group actions-->
          <div
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
          </div>
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
          @on-sort="sort"
          @on-items-select="onItemSelect"
          :data="tableData"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
          
        >
          <template v-slot:id="{ row: table }">
            {{ table.id}}
          </template>
          <template v-slot:role_name="{ row: table }">
          
              {{ table.role_name }}
          
          </template>
        </Datatable>
      </div>
    </div>
    <RolesAddNewModal :items="tableData"></RolesAddNewModal>
   
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
  import RolesAddNewModal from "@/containers/applications/RolesAddNewModal.vue";
  import arraySort from "array-sort";
import ApiService from "@/core/services/ApiService";
import { useI18n } from "vue-i18n";

 interface items{
    id:number;
    role_name:string;
 }

  export default defineComponent({
    name: "roles",
    components: {
      Datatable,
     
      RolesAddNewModal,
    },
    setup() {
      const tableHeader = ref([
        {
          columnName: "serialno",
          columnLabel: "id",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "userscore",
          columnLabel: "role_name",
          sortEnabled: true,
          columnWidth: 230,
        },
        
      ]);
      const { t, te } = useI18n();

      const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
      };
      const selectedIds = ref<Array<number>>([]);
  
      const tableData = ref<Array<items>>([]);
      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
      ApiService.get("showRoles")
      .then(({ data }) => {
        console.log('rolesdata', data);
        tableData.value = data;
      });
     
      });
  
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
  
      return {
        tableData,
        tableHeader,
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
  