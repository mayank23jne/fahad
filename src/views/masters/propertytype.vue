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
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#kt_modal_add_propertytype"
            >
              <span class="svg-icon svg-icon-2">
                <inline-svg src="/media/icons/duotune/arrows/arr075.svg" />
              </span>
              {{translate('addnew')}}
            </button>
            <!--end::Add customer-->
          </div>
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
      <div class="card-body pt-0">
        <Datatable
          @on-items-select="onItemSelect"
          :data="propertytype"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
          :checkbox-enabled="true"
          checkbox-label="id"
        >
            <template v-slot:name="{ row: table }" v-if="lang=='en' || lang == 'enrtl'">
                {{ table.name_en }}
            </template>
            <template v-slot:name="{ row: table }" v-else>
                {{ table.name_ar }}
            </template>
            <template v-slot:status="{ row: table }"  >
                <!-- {{ table.status }} -->
                <i class="fa fa-unlock text-success fs-3 " aria-hidden="true" v-if="table.status == 1" @click="statuschange(table.status, table.id)"></i>
                <i class="fa fa-lock text-danger fs-3 " aria-hidden="true" v-else @click="statuschange(table.status, table.id)"></i>
            </template>
            <template v-slot:action="{ row: table }" >
              <i class="fa fa-archive text-warning fs-3 m-2" aria-hidden="true" @click="archivechange(table.is_deleted,table.id)"></i>
              <i class="fa fa-pencil text-primary fs-3 m-2" aria-hidden="true"  @click="editrow(table.id)"></i>
               <i class="fa fa-trash text-danger fs-3 m-2" aria-hidden="true" @click="deleterow(table.id)"></i>
            </template>
            <!-- <template v-slot:edit="{ row: table }">
             
            
            </template>
            <template v-slot:delete="{ row: table }">
            
            </template> -->
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
                <a @click="deleteCustomer(customer.id)" class="menu-link px-3"
                  >Delete</a
                >
              </div> -->
              <!--end::Menu item-->
            <!-- </div> -->
            <!--end::Menu-->
         
        </Datatable>
      </div>
    </div>

      <PropertyTypeAddNewModal :propertytype="propertytype"  ></PropertyTypeAddNewModal>
      <!-- <EditIndustryTypeModel :industrytype="industrytype" :id="edit_id"></EditIndustryTypeModel> -->
    </template>
    
    <script lang="ts">
    import { defineComponent, ref, onMounted } from "vue";
    import Datatable from "@/components/kt-datatable/KTDataTable.vue";
    import { useSurveyStore } from "@/stores/survey";
    import IndustryTypeAddNewModal from "@/containers/masters/IndustryTypeAddNewModel.vue";
    import PropertyTypeAddNewModal from "@/containers/masters/PropertyTypeAddNewModal.vue";
    // import EditIndustryTypeModel from "@/containers/masters/EditIndustryTypeModel.vue";
   
  import ApiService from "@/core/services/ApiService";
  import { useI18n } from "vue-i18n";
import Swal from "sweetalert2";
import router from "@/router";
  
  interface property_type{
      name_ar: string;
      name_en : string;
      id:number;
   }
   
    export default defineComponent({
      name: "propertytype",
      components: {
        Datatable,
      //   ExportCustomerModal,
      //   AddCustomerModal,
      PropertyTypeAddNewModal
      // EditIndustryTypeModel
      },
      setup() {
        const tableHeader = ref([
          {
            columnName: "name",
            columnLabel: "name",
            sortEnabled: true,
            columnWidth: 150,
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
            columnWidth: 157,
          },
          // {
          //   columnName: "edit",
          //   columnLabel: "edit",
          //   olumnWidth: 50,
          // },
          // {
          //   columnName: "delete",
          //   columnLabel: "delete",
          //   olumnWidth: 50,

          // },
          
        ]);
         
        const propertytype = ref<Array<property_type>>([]);
        const islodaing= ref<Boolean>(true);
        const selectedIds = ref<Array<number>>([]);
        const lang = localStorage.getItem('lang');      
        const selectedItems= ref<Array<number>>([]);
          const edit_id=ref('');
      const store = useSurveyStore();
       const user_id = localStorage.getItem('logged_user_id')  as string;
      const { t, te } = useI18n();
          const translate = (text: string|any) => {
            if (te(text)) {
              return t(text);
            } else {
              return text;
            }
          }; 
  
          onMounted(() => {
          // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
          return ApiService.post('showPropertyType',{user_id:user_id})
        .then(({ data }) => {
          propertytype.value = data;
        })
        .catch(({ response }) => {
          
        });
        });
       
        const statuschange = (status, id)=>{
          let st = '0';
          if(status == '0'){
              st='1'; 
          }else{
            st='0';
          }
          ApiService.post("statusPropertyType", {status:st,
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

          return ApiService.post('archivePropertyTypes', {val:val,user_id:user_id})
        .then(({ data }) => {
          propertytype.value = data;
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
                ApiService.post("isDeletedPropertyType", {delete:st,
                id:id})
            .then(({ data }) => {  
              propertytype.value = propertytype.value.filter(e => e.id !== id);
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
          
          router.push({name: 'editpropertytype', params: { id: id }})
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
            confirmButton: "btn btn-danger m-2",
            cancelButton: "btn btn-primary m-2",
          },
        }).then((confirmed) => {
          if (confirmed.value==true) {
            ApiService.delete("deletePropertyType/"+id)
            .then(({ data }) => {
              propertytype.value = propertytype.value.filter(e => e.id !== id);
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
      
       
        const onItemSelect = (selectedItems: Array<number>) => {
          selectedIds.value = selectedItems;
        };
    
        return {
          lang,
          selectedItems,
          // toggleItem,
          propertytype,
          selectedIds,
          onItemSelect,
          tableHeader,
          translate,
          deleterow,
          editrow, 
          edit_id,
          statuschange,
          archivechange,
          showData
        };
      },
    });
    </script>
    