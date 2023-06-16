import { ref } from "vue";
import { defineStore } from "pinia";
import objectPath from "object-path";
import type LayoutConfigTypes from "@/core/config/LayoutConfigTypes";
import layoutConfig from "@/core/config/DefaultLayoutConfig";



export const useSurveyStore = defineStore("survey", () => {
    const isLoadSurveys = ref<Boolean>(false);
    const allSurveyItems = ref([]);
    const surveyItems = ref([]);
    const surveyError = ref();
//   const config = ref<LayoutConfigTypes>(layoutConfig);
//   const initial = ref<LayoutConfigTypes>(layoutConfig);

//   function getLayoutConfig(path: string, defaultValue?: string) {
//     return objectPath.get(config.value, path, defaultValue);
//   }

  function getSurveyItemStarted() {
    isLoadSurveys.value = false
    allSurveyItems.value = []
    surveyItems.value = []
  }

//   function setLayoutConfigProperty(property: string, value: any) {
//     objectPath.set(config.value, property, value);
//     localStorage.setItem(LS_CONFIG_NAME_KEY, JSON.stringify(config.value));
//   }

//   function resetLayoutConfig() {
//     config.value = Object.assign({}, initial.value);
//   }

//   function overrideLayoutConfig() {
//     config.value = initial.value = Object.assign(
//       {},
//       initial.value,
//       JSON.parse(window.localStorage.getItem(LS_CONFIG_NAME_KEY) || "{}")
//     );
//   }

  return {
    isLoadSurveys,
    allSurveyItems,
    surveyItems,
    surveyError,
    getSurveyItemStarted,
    
  };
});
