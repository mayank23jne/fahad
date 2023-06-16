import { computed } from "vue";
import { useSurveyStore } from "@/stores/survey";

export const getSurveyItems = computed((commit) => {
    return useSurveyStore().getSurveyItemStarted();
  });
  