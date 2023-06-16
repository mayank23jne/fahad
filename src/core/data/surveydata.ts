interface surveydata{ 
    id:number;
    answers_count:number;
    title:string;
    detail:string;
    category:string;
    questions:[];
    date:string;
   }
   export type { surveydata };
   export default surveydata;