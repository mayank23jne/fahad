<template>
  <div class="card">
    <div class="card-header border-0 pt-6">
      <!--begin::Card title-->
      <div class="card-title">
        <!--begin::Search-->

        <!--end::Search-->
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
          
          <!--begin::Add customer-->
          <button
            type="button"
            class="btn btn-primary"
            @click="exportexcel"          >
           {{$t('export')}}
          </button>
          <!--end::Add customer-->
        </div>
        <!--end::Toolbar-->
        
      </div>
      <!--end::Card toolbar-->
    </div>
    <div class="card-body pt-0">
      <div class="table-responsive">
     <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"  :items="tableData">
        <thead>
    <tr class="fw-bolder fs-5 text-gray-800">
      <th v-for="field in tableHeader" :key="field">
          {{ field }}
        </th>
    </tr>
  </thead>
  <tbody>
   <tr v-for="item in tableData" :key="item">
    
        <td v-for="(key,index) in tableHeader" :key ="index">
          {{ item[index] }}
        </td>
      </tr>
  </tbody>
     </table>
     </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from "vue";
import type { ICustomer } from "@/core/data/customers";
import ApiService from "@/core/services/ApiService";

export default defineComponent({
  name: "performance_hr",
  components: {
  },
  setup() {
    const tableHeader = ref([]);
    const selectedIds = ref<Array<number>>([]);
     const title = ref<String>("");  
    const tableData = ref([]);
    const initCustomers = ref<Array<ICustomer>>([]);

    onMounted(() => {
        title.value="تقرير اداء موظفي الموارد البشرية :";
         return ApiService.get('userReportsAnswer/موارد بشرية')
      .then(({ data }) => {
        //setAuth(data);
        tableHeader.value = data.header;
        tableData.value= data.answers;

      })
      .catch(({ response }) => {
        //setError(response.data.errors);
      });
     // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
    });

   const exportexcel=()=>{
    window.open('https://forms.innovativeideasbox.com/API/api/exportUserReportsAnswer/موارد بشرية', '_blank');

   }
    const onItemSelect = (selectedItems: Array<number>) => {
      selectedIds.value = selectedItems;
    };

    return {
      tableData,
      tableHeader,
     exportexcel,
      selectedIds,
     
      onItemSelect,
    };
  },
});
</script>
