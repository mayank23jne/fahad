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
            data-bs-target="#kt_modal_add_survey"
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
        :data="surveydata"
        :header="tableHeader"
        :enable-items-per-page-dropdown="true"
        :checkbox-enabled="true"
        checkbox-label="id"
      >
      <template v-slot:title="{ row: table }">
        <router-link  :to="{
           name:'survey-details',
            params: {
              id: table.id
            }
           }"
           class="text-gray-600 text-hover-primary mb-1" >
            {{ table.title}}
            </router-link>
          </template>
          <template v-slot:detail="{ row: table }">
              {{ table.detail }}
          </template>
          <!-- <template v-slot:category="{ row: table }">
              {{ table.category }}
          </template> -->
          <template v-slot:industrytype="{ row: table }" >
            <span v-for="industry in industrytype" :key="industry" v-if="industrytype !== '' && industrytype.length > 0 "
            ><span  v-if="industry.id== table.industrytype && lang=='en'||lang == 'enrtl'"> {{ industry.name_en }}</span>
            <span  v-if="industry.id== table.industrytype && lang == 'ar'"> {{ industry.name_ar }}</span> </span>
            <span v-else></span>
          </template>
          
          <template v-slot:inspectiontype="{ row: table }" >
            <span v-for="ins in inspectiontype" :key="ins" v-if="inspectiontype !== '' && inspectiontype.length > 0 "
            ><span  v-if="ins.id== table.inspectiontype && lang=='en'||lang == 'enrtl'"> {{ ins.name_en }}</span> 
            <span  v-if="ins.id== table.inspectiontype && lang=='ar'"> {{ ins.name_ar  }}</span></span>
            <span v-else></span>
          </template>
          <template v-slot:inspectionproperty="{ row: table }">
            <span v-for="inspection in inspectionproperty" :key="inspection" v-if="inspectionproperty !== '' && inspectionproperty.length > 0 "
            ><span  v-if="inspection.id== table.inspectionproperty && lang=='en'||lang == 'enrtl'"> {{ inspection.propertyname_en }}</span>
            <span  v-if="inspection.id== table.inspectionproperty && lang=='ar'"> {{ inspection.propertyname_ar }}</span>  </span>
            <span v-else></span>
          </template>
          <template v-slot:registeredproperty="{ row: table }">
            <span v-for="register in registeredproperty" :key="register" v-if="registeredproperty !== '' && registeredproperty.length > 0 "
            ><span  v-if="register.id== table.registeredproperty "> {{ register.building_no }}</span>
            </span>
            <span v-else></span>
          </template>
          <template v-slot:offices="{ row: table }">
            <span v-for="office in offices" :key="office" v-if="offices !== '' && offices.length > 0 "
            ><span  v-if="office.id== table.officefield "> {{ office.property_list}}</span>
           </span>
            <span v-else></span>
          </template>
          <template v-slot:date="{ row: table }">
              {{ table.date }}
          </template>
          <template v-slot:action="{ row: table }">
            <router-link  :to="{
           name:'survey-details',
            params: {
              id: table.id
            }
           }"
           class="text-gray-600 text-hover-primary mb-1" >
           <i class="fa fa-pencil  text-primary fs-3 m-2" aria-hidden="true" ></i>
            </router-link>
            <i class="fa fa-trash  text-danger fs-3 m-2" aria-hidden="true" @click="deleterow(table.is_deleted,table.id)"></i>
          </template>
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
                <!--begin::Add customer-->
                <!-- <div class="row d-flex justify-content-end mb-5" >
                    <div class="col-md-3 ">
                    <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#kt_modal_add_survey"
                    >
                    <span class="svg-icon svg-icon-2">
                        <inline-svg src="/media/icons/duotune/arrows/arr075.svg" />
                    </span>
                   Add New
                    </button>
                </div>
                </div> -->
                
            <!--end::Add customer-->
            <!-- <div class="card-body pt-0" v-for="(item,index) in surveydata" :key="`item${index}`"> -->
        <!-- <h5>{{ item.id }}</h5> -->
        <!-- <SurveyListItem
        :key="item.id" 
        :data="item"
        :selected-items="selectedItems"
        @toggle-item="toggleItem"
      
        ></SurveyListItem> -->
      <!-- </div> -->
<!--   
    <ExportCustomerModal></ExportCustomerModal>
    <AddCustomerModal></AddCustomerModal> -->
    <SurveyAddNewModal :categories="categories" :surveydata="surveydata" :labels="labels" :statuses="statuses" :industrytype="industrytype"
      :inspectiontype ="inspectiontype"
       :inspectionproperty="inspectionproperty"
       :registeredproperty="registeredproperty"
       ></SurveyAddNewModal>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import { useSurveyStore } from "@/stores/survey";
  import ExportCustomerModal from "@/components/modals/forms/ExportCustomerModal.vue";
  import AddCustomerModal from "@/components/modals/forms/AddCustomerModal.vue";
  import SurveyAddNewModal from "@/containers/applications/SurveyAddNewModal.vue";
  
  import SurveyListItem from "@/components/SurveyApp/SurveyListItem.vue";
 
import ApiService from "@/core/services/ApiService";
import { useI18n } from "vue-i18n";
import Swal from "sweetalert2";

interface surveydata{
    answers_count: number;
category : string;
date: string;
detail: string;
id:number;
questions: [];
title: string;
 }
 
  export default defineComponent({
    name: "survey",
    components: {
      Datatable,
    //   ExportCustomerModal,
    //   AddCustomerModal,
      SurveyAddNewModal,
      SurveyListItem,
    },
    setup() {
      const tableHeader = ref([
        {
          columnName: "title",
          columnLabel: "title",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: 'thedetails',
          columnLabel: "detail",
          sortEnabled: true,
          columnWidth: 230,
        },
        // {
        //   columnName: "cat",
        //   columnLabel: "category",
        //   sortEnabled: true,
        //   columnWidth: 175,
        // },
        {
          columnName: "industrytype",
          columnLabel: "industrytype",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "inspectiontype",
          columnLabel: "inspectiontype",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "inspectionpropertytype",
          columnLabel: "inspectionproperty",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "registeredproperty",
          columnLabel: "registeredproperty",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "offices",
          columnLabel: "offices",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "thedate",
          columnLabel: "date",
          sortEnabled: true,
          columnWidth: 230,
        },
        {
          columnName: "action",
          columnLabel: "action",
          sortEnabled: true,
          columnWidth: 100,
        },
        
      ]);
        const sortOptions= ref([
        {
          column: "title",
          label: "Title"
        },
        {
          column: "category",
          label: "Category"
        },
        {
          column: "label",
          label: "Label"
        },
        {
          column: "status",
          label: "Status"
        }
      ]);
      
      const categories= ref([
      {
          label: "موارد بشرية",
          value: "موارد بشرية"
        },
        {
          label: "اماكن",
          value: "اماكن"
        },
        {
          label: "اجهزة",
          value: "Hardware"
        }
      ]);

      // const masters= ref([
      // {
      //     label: "industrytype",
      //     value: "نوع الصناعة"
      //   },
      //   {
      //     label: "inspectiontype",
      //     value: "نوع الفحص"
      //   },
      //   {
      //     label: "inspectionpropertytype",
      //     value: "نوع خاصية الفحص"
      //   },
      //   {
      //     label: "registeredproperty",
      //     value: "الملكية المسجلة"
      //   }
      // ]);

     const labels= ref([
        {
          label: "EDUCATION",
          value: "EDUCATION",
          color: "secondary"
        },
        {
          label: "NEW FRAMEWORK",
          value: "NEW FRAMEWORK",
          color: "primary"
        },
        {
          label: "PERSONAL",
          value: "PERSONAL",
          color: "info"
        }
      ]);
      const statuses=ref([
        {
          text: "ACTIVE",
          value: "ACTIVE"
        },
        {
          text: "COMPLETED",
          value: "COMPLETED"
        }
      ]);
      const surveydata = ref<Array<surveydata>>([]);
      const islodaing= ref<Boolean>(true);
      const selectedIds = ref<Array<number>>([]);
      const industrytype = ref<any>([]);
      const inspectiontype = ref<any>([]);
      const inspectionproperty = ref<any>([]);
      const registeredproperty = ref<any>([]);
      const offices = ref<any>([]);
      const selectedItems= ref<Array<number>>([]);
      const user_id = localStorage.getItem('logged_user_id')  as string;
      const store = useSurveyStore();
      const lang = localStorage.getItem('lang');
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
         ApiService.get('show')
      .then(({ data }) => {
        surveydata.value = data.data;
      })
      .catch(({ response }) => {
      });

      ApiService.post('showIndustryType',{user_id:user_id})
        .then(({ data }) => {
          industrytype.value = data;
        })
        .catch(({ response }) => {
          
        });

        ApiService.get('showAllInspectionTypes')
        .then(({ data }) => {
          inspectiontype.value = data;
        })
        .catch(({ response }) => {
          
        });

        ApiService.post('showInspectionProperty',{user_id:user_id})
        .then(({ data }) => {
          inspectionproperty.value = data;
        })
        .catch(({ response }) => {
          
        });

        ApiService.post('showRegisteredProperty',{user_id:user_id})
        .then(({ data }) => {
          registeredproperty.value = data;
        })
        .catch(({ response }) => {
          
        });

        ApiService.get('showRegisteredFields')
        .then(({ data }) => {
          offices.value = data;
        })
        .catch(({ response }) => {
          
        });

      });
  
      const getIndex = (value, arr, prop) => {
      for (var i = 0; i < arr.length; i++) {
        if (arr[i][prop] === value) {
          return i;
        }
      }
      return -1;
    };

    //  const toggleItem=(event, itemId) =>{
    //   if (event.shiftKey && selectedItems.value.length > 0) {
    //     let itemsForToggle = store.surveyItems;
    //     var start = getIndex(itemId, itemsForToggle, "id");
    //     var end = getIndex(
    //       selectedItems[selectedItems.value.length - 1],
    //       itemsForToggle,
    //       "id"
    //     );
    //     itemsForToggle = itemsForToggle.slice(
    //       Math.min(start, end),
    //       Math.max(start, end) + 1
    //     );
    //     selectedItems.value.push(
    //       ...itemsForToggle.map(item => {
    //         return item.id;
    //       })
    //     );
    //   } else {
    //     if (selectedItems.value.includes(itemId)) {
    //       selectedItems.value = selectedItems.value.filter(x => x !== itemId);
    //     } else {
    //       selectedItems.value.push(itemId);
    //     }
    //   }
    // };
        const deleterow = (is_deleted, id)=> {
       console.log(id, is_deleted);
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
            let st = '0';
          if(is_deleted == '0'){ 
              st='1'; 
          }else{
            st='0';
          }

            ApiService.post("isDeleteTemplate",{delete:st, id:id})
            .then(({ data }) => {
              console.log(data);
              surveydata.value = surveydata.value.filter(e => e.id !== id);
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
        surveydata,
        selectedItems,
        // toggleItem,
        categories,
        statuses,
        labels,
        selectedIds,
        onItemSelect,
        tableHeader,
        translate,
        industrytype,
        inspectiontype,
        inspectionproperty,
        registeredproperty ,
        lang,
        offices,
        deleterow
      };
    },
  });
  </script>
  