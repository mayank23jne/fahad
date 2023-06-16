<template>
    <div class="card pt-6">
      <!-- <div class="card-header border-0 pt-6"> -->
        <!--begin::Card title-->
        <!-- <div class="card-title">
          
        </div> -->
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
          <template v-slot:firstname="{ row: table }">
            {{ table.firstname}}
          </template>
          <template v-slot:lastname="{ row: table }">
              {{ table.lastname }}
          </template>
          <template v-slot:mobile="{ row: table }">
              {{ table.mobile }}
          </template>
          <template v-slot:nationality="{ row: table }">
              {{ table.nationality }}
          </template>
          <template v-slot:email="{ row: table }">
              {{ table.email }}
          </template>
          <template v-slot:role="{ row: table }">
              {{ table.role }}
          </template>
       
          <template v-slot:validity="{ row: table }" >
          <button
          @click="gotopage(table.id)"
            class="btn btn-sm btn-light btn-active-light-primary"
            >{{translate('powers')}}
          </button>
        </template>
        <template v-slot:status="{ row: table }"  >
                <!-- {{ table.status }} -->
                <i class="fa fa-unlock  text-success fs-3" aria-hidden="true" v-if="table.status == 1" @click="statuschange(table.status, table.id)"></i>
                <i class="fa fa-lock  text-danger fs-3" aria-hidden="true" v-else @click="statuschange(table.status, table.id)"></i>
            </template>
        <template v-slot:action="{ row: table }" >
          <i class="fa fa-key text-warning fs-3 m-2" aria-hidden="true" @click="passwordReset(table.id)"></i>
          <i class="fa fa-trash text-danger fs-3 m-2 " aria-hidden="true" @click="deleterow(table.is_deleted,table.id)"></i>
        </template>
        
        </Datatable>
      </div>
    </div>
   
  <ChangePasswordModal :id="editid"></ChangePasswordModal>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
 import ChangePasswordModal from "@/containers/applications/ChangePasswordModal.vue";
  import arraySort from "array-sort";
import ApiService from "@/core/services/ApiService";
import router from "@/router";
import { useI18n } from "vue-i18n";
import Swal from "sweetalert2";
import { Modal } from "bootstrap";

 interface items{
    email:string;
    role:string;
    lastname:string;
    firstname:string;
    id:number;
    mobile:number;
    nationality:string;
 }

  export default defineComponent({
    name: "usersupdate",
    components: {
      Datatable,
      ChangePasswordModal
    },
    setup() {
      const tableHeader = ref([
        {
          columnName: "firstname",
          columnLabel: "firstname",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "lastname",
          columnLabel: "lastname",
          sortEnabled: true,
          columnWidth: 200,
        },
        {
          columnName:  "mobile",
          columnLabel: "mobile",
          sortEnabled: true,
          columnWidth: 200,
        },
        {
          columnName: "nationality" ,
          columnLabel: "nationality",
          sortEnabled: true,
          columnWidth: 200,
        },
        {
          columnName: "e_mail",
          columnLabel: "email",
          sortEnabled: true,
          columnWidth: 170,
        },
        {
          columnName: "function",
          columnLabel: "role",
          sortEnabled: true,
          columnWidth: 170,
        },
       
        {
          columnName: "validity",
          columnLabel: "validity",
          sortEnabled: true,
          columnWidth: 50,
        },
        {
          columnName: "status",
          columnLabel: "status",
          sortEnabled: true,
          columnWidth: 50,
        },
        {
          columnName: "action",
          columnLabel: "action",
          sortEnabled: true,
          columnWidth: 100,
        },
        
      ]);
      const { t, te } = useI18n();
      const  currentPage= ref(1);
      const selectedIds = ref<Array<number>>([]);
  
      const tableData = ref<Array<items>>([]);
        const editid=ref("");
        const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
         ApiService.get(`showAllClientsData`)
      .then(({ data }) => {
       
        tableData.value = data.data;
         
      });
     
      });

       const gotopage=(id)=>
       {
        router.push({name: 'permissions', params: { user_id: id }})
       }
  
       const statuschange = (status, id)=>{
          let st = '0';
          if(status == '0'){
              st='1'; 
          }else{
            st='0';
          }
          ApiService.post("changeStatus", {status:st,
          id:id})
      .then(({ data }) => {  
      setTimeout(() => {
        Swal.fire({
          text: translate("savedsuccess"),
          icon: "success",
          buttonsStyling: false,
          confirmButtonText: translate('okgotit'),
          heightAuto: false,
          customClass: {
            confirmButton: "btn btn-primary",
          },
        }).then(() => {
          router.go(0);
        });
      }, 2000);
      
    });
        }
  
      const deleterow=(is_deleted, id)=>
        {  
          Swal.fire({
            title: translate('areyousure'),
            text: translate('notretrivedata'),
          icon: "warning",
          buttonsStyling: false,
          showCancelButton: true,
          confirmButtonText: translate('yesdelete'),
          cancelButtonText: translate('nocancel'),
          heightAuto: false,
          customClass: {
            confirmButton: "btn btn-danger m-2",
            cancelButton: "btn btn-primary m-2",
          },
        }).then((confirmed) => {
          if (confirmed.value==true) {
            
            ApiService.post("isDeleteClient", {delete:1,
          id:id})
            .then(({ data }) => {
             
              tableData.value = tableData.value.filter(e => e.id !== id);
              setTimeout(() => {
              Swal.fire({
                text: translate('deletesuccess'),
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: translate('okgotit'),
                heightAuto: false,
                customClass: {
                  confirmButton: "btn btn-primary",
                },
              }).then(() => {
                // hideModal(addUnittypeModalRef.value);
              });
            }, 500); 
            });
          }else{
            setTimeout(() => {
              Swal.fire({
                text: translate('cancelerror'),
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: translate('okgotit'),
                heightAuto: false,
                customClass: {
                  confirmButton: "btn btn-primary",
                },
              }).then(() => {
                // hideModal(addUnittypeModalRef.value);
              });
            }, 500); 
          }
            
        });
    }

    const passwordReset = (id) =>{
      console.log('id', id);
      editid.value= id;
      const modal_id :any = document.getElementById("kt_modal_change_password");
          const myModal = new Modal(modal_id);
          myModal.show();
    }
  
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
        gotopage,
       
        search,
        selectedIds,
        deleterow,
        sort,
        onItemSelect,
        translate,
        statuschange,
        passwordReset,
        editid
      };
    },
  });
  </script>
  