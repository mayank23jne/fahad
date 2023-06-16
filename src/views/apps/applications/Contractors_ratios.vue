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
          <!-- <div
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
              >اضافة درجة مستخدم جديد
            </button>
           
          </div> -->
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
        </div>
        <!--end::Card toolbar-->
      </div>
      <!-- <div v-for="table in tableData">
        <h1>{{ table.company_name }}</h1>
      </div> -->
      
      <div class="card-body pt-0">
        <div class="col-xl-12" v-if="loaded">
          <div class="row">
            <div class="col-xl-6"  v-for="(value, index) in listdata"
              :key="index">
          <KTChartWidgetDonut widget-classes="card-xl-stretch mb-xl-8"
          :data="value" 
              ></KTChartWidgetDonut> 
      </div>
        </div>
        </div>
       
    </div>
    </div>
    <!-- <RolesAddNewModal :items="tableData"></RolesAddNewModal> -->
   
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
  import RolesAddNewModal from "@/containers/applications/RolesAddNewModal.vue";
  import arraySort from "array-sort";
import ApiService from "@/core/services/ApiService";
import KTChartWidgetDonut from "@/components/widgets/charts/WidgetDonut.vue";

 interface items{
   labels:string;
   datasets:{};
 }

  export default defineComponent({
    name: "Contractors_ratios",
    components: {
      Datatable,
      KTChartWidgetDonut
    },
    setup() {
      const listdata=ref<Array<items>>([]); 
      const names=ref([]); 
      const loaded=ref<boolean>(false); 
      const selectedIds = ref<Array<number>>([]);
  
      const tableData = ref<Array<items>>([]);
      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
      ApiService.get("companyChart")
      .then(({ data }) => {
        tableData.value = data;
        data.forEach((val, index) => {
        listdata.value.push({
          labels: val.data,
          
          datasets: [
            {
              borderWidth: 2,
              data: val.Values,
              name: val.Name,
              company_id:val.company_id
            },
          ],
        });
      });
      loaded.value = true;
      });
     
      });
  
  
  
      return {
        listdata,
        loaded
      };
    },
  });
  </script>
  