<template>
    <div class="card">
      <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title text-center">
          <h1 class=" text-center"> {{ title }}</h1>
       
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
          <!--begin::Toolbar-->
         
          <!--end::Toolbar-->
          <!--begin::Group actions-->
        
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
      
          :data="items"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
          :checkbox-enabled="true"
          checkbox-label="id"
        >
        <template v-slot:created_at="{ row: customer }">
            {{ customer.created_at}}
          </template>
          <template v-slot:user="{ row: customer }">
            {{ customer.user}}
          </template>
          <!-- <template v-slot:nationality="{ row: customer }">
              {{ customer.nationality }}
          </template> -->
          <template v-slot:date="{ row: customer }">
              {{ customer.date }}
          </template>
          <!-- <template v-slot:pilgrims="{ row: customer }">
              {{ customer.pilgrims }}
          </template> -->
          <template v-slot:permissions="{ row: customer }">
              {{ customer.permissions }}
          </template>
          <!-- <template v-slot:unit_number="{ row: customer }">
              {{ customer.unit_number }}
          </template> -->
         
          <template v-slot:building_number="{ row: customer }">
              {{ customer.building_number }}
          </template>
          <template v-slot:actions="{ row: customer }">
            <button
            @click="gotopage(customer.id)"
            class="btn btn-sm btn-light btn-active-light-primary"
            >{{translate('details')}}
          </button>
          </template>
          <template v-slot:print="{ row: customer }">
            <button
          @click="gotoprint(customer.id)"
            class="btn btn-sm btn-light btn-active-light-primary"
            >{{translate('print')}}
          </button>
          </template>
          <template v-slot:edit="{ row: customer }">
            <button
            @click="gotoedit(customer.id)"
            class="btn btn-sm btn-light btn-active-light-primary"
            >{{translate('amendment')}}
          </button>
          </template>
        </Datatable>
      </div>
    </div>
  
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
import Datatable from "@/components/kt-datatable/KTDataTable.vue";
import Dropdown3 from "@/components/dropdown/Dropdown3.vue";
  import type { Sort } from "@/components/kt-datatable//table-partials/models";
import ApiService from "@/core/services/ApiService";
import customers from "@/core/data/customers";
import type { ICustomer } from "@/core/data/customers";
import { adminRoot } from "@/components/constants/config";
import router from "@/router";
import { useI18n } from "vue-i18n";

//  interface surveydata{
//     answers_count: number;
// category : string;
// date: string;
// detail: string;
// id:number;
// questions: [];
// title: string;
//  }

  export default defineComponent({
    name: "unitreport",
    props:['id'],
    components: {
      Datatable,
      Dropdown3,
    },
    setup(props) {
        const tableHeader = ref([
        {
          columnName:  "thedate",
          columnLabel: 'created_at',
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "theuser",
          columnLabel: 'user',  
          sortEnabled: true,
          columnWidth: 150,
        },
        // {
        //   columnName:  'nationality',
        //   columnLabel: 'nationality', 
        //   sortEnabled: true,
        //   columnWidth: 150,
        // },
        // {
        //   columnName: "noofpilgrims",
        //   columnLabel: 'pilgrims',
        //   sortEnabled: true,
        //   columnWidth:150,
        // },
        {
          columnName: "permitno",
          columnLabel: 'permissions',
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName: "buildingn",
          columnLabel: 'building_number', 
          sortEnabled: true,
          columnWidth:150,
        },
        // {
        //   columnName:  "executiveunit",
        //   columnLabel: 'unit_number',
        //   sortEnabled: true,
        //   columnWidth: 150,
        // },
        {
          columnName: "theevent",
          columnLabel: 'actions', 
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "printing",
          columnLabel: "print",
          sortEnabled: true,
          columnWidth: 150,
        },
        {
          columnName:  "amendment",
          columnLabel: "edit",
          sortEnabled: true,
          columnWidth: 150,
        },
      ]);
      const tableData = ref<Array<ICustomer>>(customers);
    
      const selectedIds = ref<Array<number>>([]);
      const title=ref<String>('');
        const detail=ref<String>('');
      const items = ref<Array<string>>([]);
        const  isadmin=ref<boolean>(false);

        const { t, te } = useI18n();
        const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        }; 

        onMounted(() => {
            let permissions:any=localStorage.getItem('permissions');
            if(permissions.indexOf(1) !== -1)
                {
                isadmin.value=true
                }
           let id = props.id;     
         ApiService.get(`showDetailedAns/${id}`)
       .then(({ data }) => {
        title.value = data.title;
        items.value = data.data.map((item, index)=>{
            return {
          //  fullName: `${item.user.firstname} ${item.user.lastname}`,
             id: item.id,
            created_at:new Date (item.created_at).toLocaleString(),
            user:`${item.user[0].firstname} ${item.user[0].lastname}`,
            nationality:item.nationality,
            pilgrims:item.pilgrims,
            permissions:item.permissions,
            unit_number:item.unit_number,
            building_number:item.building_number
        };
        });
        });  
        });


       const gotoedit=(id)=>
    {
        router.push({ name: 'editlist',params:{id:props.id,template_id:id}})

    }
    const gotopage=(id)=>
    {
      router.push({ name: 'success',params:{id:id}});
     
    }
    const gotoprint=(id)=>
       {
         window.open(`https://forms.innovativeideasbox.com/API/api/print/${id}`, '_blank');
       }


      return {
        items,
        tableHeader,
        selectedIds,
        title,
        detail,
        tableData,
        gotoedit,
        gotopage,
        gotoprint,
        translate
      };
    },
  });
  </script>
  