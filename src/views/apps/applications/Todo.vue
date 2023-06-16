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
        </div> -->
        <!--end::Group actions-->
      </div>
      <!--end::Card toolbar-->
    </div>
  
    <div class="card-body pt-0">
      <Datatable
        :data="dataList"
        :header="tableHeader"
        :enable-items-per-page-dropdown="true"
        
      >
        <template v-slot:question="{ row: item }">
           <router-link  :to="{
      name: 'usertodo',
      params: {
        id: item.task_id
      }
    }"
           class="text-gray-600 text-hover-primary mb-1" >
        
          {{ item.question }}
           </router-link>
        </template>
        <template v-slot:status="{ row: item }">
            {{ item.status }}
        </template>
        <template v-slot:Date="{ row: item }">
          {{ item.Date }}
        </template>
        <template v-slot:detail="{ row: item }">
         {{ item.detail }}
        </template>
        
        <!-- <template v-slot:actions="{ row: item }">
          <a
            href="#"
            class="btn btn-sm btn-light btn-active-light-primary"
            data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-end"
            data-kt-menu-flip="top-end"
            >Actions{{item.task_id}}
            <span class="svg-icon svg-icon-5 m-0">
              <inline-svg src="/media/icons/duotune/arrows/arr072.svg" />
            </span>
          </a> -->
          <!--begin::Menu-->
          <!-- <div
            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semobold fs-7 w-125px py-4"
            data-kt-menu="true"
          > -->
            <!--begin::Menu item-->
            <!-- <div class="menu-item px-3">
              <router-link
                to="/apps/customers/customer-details"
                class="menu-link px-3"
                >View</router-link
              >
            </div> -->
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <!-- <div class="menu-item px-3">
              <a @click="deleteCustomer(item.task_id)" class="menu-link px-3"
                >Delete</a
              >
            </div> -->
            <!--end::Menu item-->
          <!-- </div> -->
          <!--end::Menu-->
        <!-- </template> -->
      </Datatable>
    </div>
  </div>

 <!-- / <ExportCustomerModal></ExportCustomerModal> -->
  <!-- <n AddCustomerModal></AddCustomerModal> -->
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, toRaw } from "vue";
import { ErrorMessage, Field, Form as VForm } from "vee-validate";
import { useTodoStore, type Todo } from "@/stores/todo";
import { useRouter } from "vue-router";
import Datatable from "@/components/kt-datatable/KTDataTable.vue";
import type { Sort } from "@/components/kt-datatable//table-partials/models";
// import ExportCustomerModal from "@/components/modals/forms/ExportCustomerModal.vue";
// import AddCustomerModal from "@/components/modals/forms/AddCustomerModal.vue";
import customers from "@/core/data/customers";
import type { ICustomer } from "@/core/data/customers";
import arraySort from "array-sort";

export default defineComponent({
  name: "todo-listing",
  components: {
    Datatable,
    // ExportCustomerModal,
    // AddCustomerModal,
  },
  setup() {
    const store = useTodoStore();
    const router = useRouter();
    const tableHeader = ref([
      {
        columnName: "question",
        columnLabel: "question",
        sortEnabled: true,
        columnWidth: 175,
      },
      {
        columnName: "status",
        columnLabel: "status",
        sortEnabled: true,
        columnWidth: 230,
      },
      {
        columnName: "date",
        columnLabel: "Date",
        sortEnabled: true,
        columnWidth: 175,
      },
      {
        columnName: "detail",
        columnLabel: "detail",
        sortEnabled: true,
        columnWidth: 175,
      },
      // {
      //   columnName: "Actions",
      //   columnLabel: "actions",
      //   sortEnabled: false,
      //   columnWidth: 135,
      // },
    ]);
  
   const currentPage = ref<number>(1);
   const totalRows = ref<number>(0);
    const selectedIds = ref<Array<number>>([]);
      const dataList = ref<Array<Todo["data"]>>([]);
     const tableData = ref<Array<Todo>>([]);
    // const tableData = ref<Array<ICustomer>>([]);
    const initCustomers = ref<Array<ICustomer>>([]);
    const URL = `showTaskInfo/${localStorage.getItem('logged_user_id')}?page=${currentPage.value}`;
    onMounted(async () => {

      await store.getCurrentPage(URL);
       dataList.value = JSON.parse(JSON.stringify(store.todoList.data));
    });

    const deleteFewCustomers = () => {
      selectedIds.value.forEach((item) => {
        deleteCustomer(item);
      });
      selectedIds.value.length = 0;
    };

    const deleteCustomer = (id: number) => {
      for (let i = 0; i < tableData.value.length; i++) {
        // if (tableData.value[i].id === id) {
        //   tableData.value.splice(i, 1);
        // }
      }
    };

    const search = ref<string>("");
    const searchItems = () => {
      // tableData.value.splice(0, tableData.value.length, ...initCustomers.value);
      if (search.value !== "") {
        let results: Array<ICustomer> = [];
        for (let j = 0; j < dataList.value.length; j++) {
          if (searchingFunc(dataList.value[j], search.value)) {
          //   results.push(dataList.value[j]);
          }
        }
        // tableData.value.splice(0, tableData.value.length, ...results);
      }
    };

    const searchingFunc = (obj: any, value: string): boolean => {
      for (let key in obj) {
        if (!Number.isInteger(obj[key]) && !(typeof obj[key] === "object")) {
          if (obj[key].indexOf(value) != -1) {
            return true;
          }
        }
      }
      return false;
    };

    const sort = (sort: Sort) => {
      const reverse: boolean = sort.order === "asc";
      if (sort.label) {
        arraySort(tableData.value, sort.label, { reverse });
      }
    };
    const onItemSelect = (selectedItems: Array<number>) => {
      selectedIds.value = selectedItems;
    };
          // Send login request
      
    //   const getCurrentPage = () => {
    //   setHeaderAuth();
         
    //      axios(URL).then((res)=>
    //      {
    //       let itemsArrLength = this.todolist.length
    //   let totalLength = res.data.Count
    //   if (itemsArrLength < totalLength)
    //   {
    //     //  this.todolist.push(...res.data.data)
    //     this.todolist=res.data.data
    //   }

    //      })
    // };


    return {
      dataList,
      tableData,
      tableHeader,
      deleteCustomer,
      search,
      searchItems,
      selectedIds,
      deleteFewCustomers,
      sort,
      onItemSelect,
    };
  },
});
</script>
