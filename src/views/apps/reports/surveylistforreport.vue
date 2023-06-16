<template>
    <div class="card p-6">
      
      <!-- <div v-for="table in tableData">
        <h1>{{ table.company_name }}</h1>
      </div> -->
      
      <div class="card-body pt-0">
        <Datatable
          :data="surveydata"
          :header="tableHeader"
          :enable-items-per-page-dropdown="true"
          
        >
          <template v-slot:title="{ row: table }">
            <router-link  :to="{
            name: 'unitreport',
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
          <template v-slot:inspectiontype="{ row: table }" >
            <span v-for="ins in inspectiontype" :key="ins" v-if="inspectiontype !== '' && inspectiontype.length > 0 "
            ><span  v-if="ins.id== table.inspectiontype && lang=='en'||lang == 'enrtl'"> {{ ins.name_en }}</span> 
            <span  v-if="ins.id== table.inspectiontype && lang=='ar'"> {{ ins.name_ar  }}</span></span>
            <span v-else></span>
          </template>
          <template v-slot:date="{ row: table }">
              {{ table.date }}
          </template>
        </Datatable>
      </div>
    </div>
  
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted, watch } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
import ApiService from "@/core/services/ApiService";
import { useI18n } from "vue-i18n";

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
    name: "surveylistforreport",
   
    components: {
      Datatable,
    },
    setup(props) {
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
        {
          columnName: "inspectiontype",
          columnLabel: "inspectiontype",
          sortEnabled: true,
          columnWidth: 175,
        },
        {
          columnName: "thedate",
          columnLabel: "date",
          sortEnabled: true,
          columnWidth: 230,
        },
        
      ]);
      const selectedIds = ref<Array<number>>([]);
      const title=ref<String>('');
      const surveydata = ref<Array<surveydata>>([]);
        const inspectiontype = ref<any>([]);
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
         ApiService.get("show")
      .then(({ data }) => {
        surveydata.value = data.data;
      });  

      ApiService.get('showAllInspectionTypes')
        .then(({ data }) => {
          inspectiontype.value = data;
        })
        .catch(({ response }) => {
          
        });
      });

      return {
        surveydata,
        tableHeader,
        selectedIds,
        title,
        inspectiontype,
        lang
      };
    },
  });
  </script>
  