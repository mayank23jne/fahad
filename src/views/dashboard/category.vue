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
          <div class="d-flex flex-wrap my-1">
      <!--begin::Select wrapper-->
              <div class="m-0">
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
              </div>
              <!--end::Select wrapper-->
            </div>
            
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#kt_modal_add_category"
            >
              <span class="svg-icon svg-icon-2">
                <inline-svg src="/media/icons/duotune/arrows/arr075.svg" />
              </span
              >{{translate('addusergroup')}}
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
          @on-items-select="onItemSelect"
          :data="tableData"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
         
        >
          <template v-slot:id="{ row: table }">
            {{ table.id}}
          </template>
          <template v-slot:category="{ row: table }">
             <span v-if="lang === 'ar'">{{ table.category }}</span>
              
             <span v-else>{{ table.category_en }}</span>
          </template>
          <template v-slot:status="{ row: table }"  >
                <!-- {{ table.status }} -->
                <i class="fa fa-unlock  text-success fs-3" aria-hidden="true" v-if="table.status == 1" @click="statuschange(table.status, table.id)"></i>
                <i class="fa fa-lock  text-danger fs-3" aria-hidden="true" v-else @click="statuschange(table.status, table.id)"></i>
            </template>
            <template v-slot:action="{ row: table }" >
              <i class="fa fa-archive  text-warning fs-3 m-2" aria-hidden="true" @click="archivechange(table.is_deleted,table.id)"></i>
              <i class="fa fa-pencil  text-primary fs-3 m-2" aria-hidden="true"  @click="editrow(table.id)"></i>
               <i class="fa fa-trash  text-danger fs-3 m-2" aria-hidden="true" @click="deleterow(table.id)"></i>
            </template>
          <!-- <template v-slot:action="{ row: table }">
          
          <button
          @click="deleterow(table.id)"
            class="btn btn-sm btn-light btn-active-light-danger"
            >{{translate('delete')}}
          </button>
      
      </template> -->
        </Datatable>
      </div>
    </div>
    <CategoryAddNewModal :items="tableData"></CategoryAddNewModal>
   
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
  import CategoryAddNewModal from "@/containers/applications/CategoryAddNewModal.vue";
  import arraySort from "array-sort";
  import ApiService from "@/core/services/ApiService";
import { hideModal } from "@/core/helpers/dom";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";
import router from "@/router";
import { Modal } from "bootstrap";

 interface items{
    id:number;
    category:string;
    category_en:string;
 }

  export default defineComponent({
    name: "category",
    components: {
      Datatable,
      CategoryAddNewModal,
    },
    setup() {
      const { t, te } = useI18n();
      const tableHeader = ref([
        {
          columnName: "serialno",
          columnLabel: "id",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "unitname",
          columnLabel: "category",
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
          columnWidth: 230,
        },
        
      ]);
      const selectedIds = ref<Array<number>>([]);
        const editid=ref("");
        const edittype=ref("");
        const editdata = ref<any>({});
      const tableData = ref<Array<items>>([]);
      const lang  = localStorage.getItem('lang');

      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
      ApiService.get("category")
      .then(({ data }) => {
        tableData.value = data;
      });
     
      });

      const statuschange = (status, id)=>{
          let st = '0';
          if(status == '0'){
              st='1'; 
          }else{
            st='0';
          }
          ApiService.post("category/changeStatus", {status:st,
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

          return ApiService.post('category/archive', {val:val})
        .then(({ data }) => {
          tableData.value = data;
        })
        .catch(({ response }) => {
          
        });
         }

        const archivechange = (is_deleted, id)=>{

          Swal.fire({
            title: translate('areyousure'),
            // text: translate('notretrivedata'),
          icon: "warning",
          buttonsStyling: false,
          showCancelButton: true,
          confirmButtonText: translate('yesarchive'),
          cancelButtonText: translate('nocancel'),
          heightAuto: false,
          customClass: {
            confirmButton: "btn btn-danger m-2",
            cancelButton: "btn btn-primary m-2",
          },
          }).then((confirmed) => {
          if (confirmed.value==true) {
          let st = '0';
          if(is_deleted == '0'){ 
              st='1'; 
          }else{
            st='0';
          }
            ApiService.post("category/isDelete", {delete:st,
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

          const editrow=(id)=>{
             console.log('id', id);
             router.push({name: 'editcategory', params: { id: id }})
        //     editid.value = id;
        //   ApiService.post("category/showbyId",{'id': id})
        // .then(({ data }) => {
        //   console.log('idatad', data[0]);
        //     editdata.value = data[0];
        //     edittype.value= data[0].type;
        //     const modal_id :any = document.getElementById("kt_modal_edit_unittype");
        //   const myModal = new Modal(modal_id);
        //   myModal.show();
        // });
          
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
            ApiService.delete("category/delete/"+id)
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

    const updateItem=()=>{

    }
     
      return {
        tableData,
        tableHeader,
        deleterow,
        deleteCustomer,
        search,
        selectedIds,
        deleteFewCustomers,
        onItemSelect,
        translate,
        editrow,   
          statuschange,
          archivechange,
          showData,
          editid,
          editdata,
          updateItem,
          edittype,
          lang
      };
    },
  });
  </script>
  