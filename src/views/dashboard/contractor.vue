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


          <!-- <div class="d-flex flex-wrap my-1"> -->
      <!--begin::Select wrapper-->
      <!-- <div class="m-0"> -->
        <!--begin::Select-->
        <select
          name="status"
          data-control="select2"
          data-hide-search="true"
          class="form-select form-select-white form-select-sm fw-bold w-150px h-30px w-md-150px h-md-40px mr-2"
          @change="showData($event)"
          style="margin-right:20px; margin-left: 20px;"
        >
          <option class="symbol symbol-20px me-4" value="0" selected>{{translate('active')}}</option>
          <option value="1">{{translate('archive')}}</option>
        </select>
        <!--end::Select-->
      <!-- </div> -->
      <!--end::Select wrapper-->
    <!-- </div> -->
            
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#kt_modal_add_contractor"
            >
              <span class="svg-icon svg-icon-2">
                <inline-svg src="/media/icons/duotune/arrows/arr075.svg" />
              </span>
              {{ translate('newcontractor') }}
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
            <!-- <button
              type="button"
              class="btn btn-danger"
              @click="deleteFewCustomers()"
            >
              Delete Selected
            </button> -->
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
          <template v-slot:company_name="{ row: table }">
          
              {{ table.company_name }}
          
          </template>
          <template v-slot:status="{ row: table }"  >
                <!-- {{ table.status }} -->
                <i class="fa fa-unlock text-success fs-3" aria-hidden="true" v-if="table.status == 1" @click="statuschange(table.status, table.id)"></i>
                <i class="fa fa-lock text-danger fs-3" aria-hidden="true" v-else @click="statuschange(table.status, table.id)"></i>
            </template>
          <template v-slot:action="{ row: table }" >
              <i class="fa fa-archive text-warning fs-3 m-2" aria-hidden="true" @click="archivechange(table.is_deleted,table.id)"></i>
              <i class="fa fa-pencil text-primary fs-3 m-2" aria-hidden="true"  @click="editrow(table.id)"></i>
              <i class="fa fa-trash text-danger fs-3 m-2" aria-hidden="true" @click="deleterow(table.id)"></i>
            </template>
        </Datatable>
      </div>
    </div>
    <ContractorAddNewModal :items="tableData"></ContractorAddNewModal>
    <EditContractorModal :items="tableData" :id="editid" :editdata="editdata && editdata"  @update="updateItem"></EditContractorModal>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
  import ContractorAddNewModal from "@/containers/applications/ContractorAddNewModal.vue";
  import EditContractorModal from "@/containers/applications/EditContractorModal.vue";
  import arraySort from "array-sort";
import ApiService from "@/core/services/ApiService";
import { useI18n } from "vue-i18n";
import Swal from "sweetalert2";
import router from "@/router";
import { Modal } from "bootstrap";

 interface items{
    id:number;
    company_name:string;
 }



  export default defineComponent({
    name: "contractor",
    components: {
      Datatable,
      ContractorAddNewModal,
      EditContractorModal
    },
    setup() {
      const { t, te } = useI18n();
      const editid=ref("");
      const tableHeader = ref([
        {
          columnName: "serialno",
          columnLabel: "id",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "contractorname",
          columnLabel: "company_name",
          sortEnabled: true,
          columnWidth: 230,
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
          columnWidth: 170,
        },
        
      ]);
      const selectedIds = ref<Array<number>>([]);
      const editdata = ref<any>({});
      const tableData = ref<Array<items>>([]);
      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
        // ApiService.setHeader();
         ApiService.get("showCompanies")
      .then(({ data }) => {
        tableData.value = data.data;
      });
     
      });

      const statuschange = (status, id)=>{
          let st = '0';
          if(status == '0'){
              st='1'; 
          }else{
            st='0';
          }
          ApiService.post("statusCompany", {status:st,
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
        
        const showData=(event)=>{
            let val = event.target.value; 
          return ApiService.post('archiveCompany', {val:val})
        .then(({ data }) => {
          tableData.value = data.data;
        })
        .catch(({ response }) => {
          
        });
         }

        const archivechange = (is_deleted, id)=>{
          let st = '0';
          if(is_deleted == '0'){ 
              st='1'; 
          }else{
            st='0';
          }
          ApiService.post("isDeletedCompany", {delete:st,
          id:id})
      .then(({ data }) => {  
        tableData.value = tableData.value.filter(e => e.id !== id);
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
          // router.go(0);
        });
      }, 2000);
      
    });
        }
       
        const editrow=(id)=>{
          editid.value = id;
          ApiService.get("showCompanyId",id)
        .then(({ data }) => {
        console.log('edit', data)
            editdata.value = data.company_name;
        });
          const modal_id :any = document.getElementById("kt_modal_edit_contractor");
          const myModal = new Modal(modal_id);
          myModal.show();
        }
    
        const deleterow=(id)=>
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
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-primary",
          },
        }).then((confirmed) => {
          if (confirmed.value==true) {
            ApiService.delete("deleteCompany/"+id)
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
            }, 2000); 
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
            }, 2000); 
          }
            
        });
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

      const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };
  

    const updateItem=()=>{

}

      return {
        tableData,
        tableHeader,
        search,
        selectedIds,
        sort,
        onItemSelect,
        translate,
        deleterow,
          editrow, 
          statuschange,
          archivechange,
          showData,
          editid,
          editdata,
          updateItem
      };
    },
  });
  </script>
  