<template>
  <div class="row g-6 g-xl-9 mb-xl-8">
    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
      color="primary"
      icon="/media/icons/duotune/abstract/abs024.svg"
        title="totalrating"
        :description="deliveddata.answershr"
      ></KTCard>
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="Pending"
        status-data-badge-color="badge-light"
        :progress="30"
        icon="/media/icons/duotune/abstract/abs027.svg"
        color="info"
        title="hrtasks"
        :description="deliveddata.Hrtasks"
        date="May 10, 2021"
        budget="$36,400.00"
      
      ></KTCard>
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
      @click="movetopage('/apps/reports/completedtask/hr')"
        status="Completed"
        status-data-badge-color="badge-light-success"
        :progress="100"
        icon="/media/icons/duotune/files/fil008.svg"
        color="success"
        title="completedtaskhr"
        :description="deliveddata.HrtasksCompleted"
        date="Mar 14, 2021"
        budget="$605,100.00"
        
      ></KTCard>
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
      @click="movetopage('/apps/reports/pendingtask/hr')"
        status="Pending"
        :progress="60"
        status-data-badge-color="badge-light"
        color="warning"
        icon="/media/icons/duotune/abstract/abs022.svg"
        title="pendingtaskhr"
        :description="deliveddata.HrconutOfPendingTasks"
        budget="$36,400.00"
        
      ></KTCard>
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
      @click="movetopage('/apps/reports/notcompletedtask/hr')"
        status="In Progress"
        :progress="40"
        color="danger"
        icon="/media/icons/duotune/arrows/arr015.svg"
        title="notcompletedtaskhr"
        :description="deliveddata.HrconutOfNotDoneTasks"
        date="May 10, 2021"
        budget="$36,400.00"
        
      ></KTCard>
    </div>
    <!--end::Col-->

  </div>
  <!-- <div class="row g-5 g-xl-8">
  
    <div  v-if="loadednatinality">
      <KTChartWidgetDonut widget-classes="card-xl-stretch mb-xl-8"
      :data="nationalityChart" 
      :height="300"
           ></KTChartWidgetDonut> 
     </div>
     
    </div> -->
    <div class="row g-5 g-xl-8  mb-xl-8">
    <div class="col-xl-6" >
      <div class="text-center">
        <h2 >{{translate('holystage')}}</h2>
      </div>
      <div class="row g-5 g-xl-8">
        <div class="col-md-6 col-xl-6">
      <KTCard
      color="success"
        icon="/media/icons/duotune/abstract/abs033.svg"
        title="noofflight"
        :description="hrReport.travelsCount"
        height = "210px"
      ></KTCard>
    </div>
    <div class="col-md-6 col-xl-6">
      <KTCard
      color="warning"
        icon="/media/icons/duotune/abstract/abs028.svg"
        title="noofpilgrims"
        :description="hrReport.pilCount"
        height = "210px"
      ></KTCard>
    </div>
    <div class="col-md-6 col-xl-6">
      <KTCard
      color="primary"
        icon="/media/icons/duotune/files/fil008.svg"
        title="totallabor"
        :description="hrReport.workers"
        height = "210px"
      ></KTCard>
    </div>
    <div class="col-md-6 col-xl-6">
      <KTCard
      color="info"
        icon="/media/icons/duotune/abstract/abs019.svg"
        title="averagetime"
        :description="hrReport.time_avg"
        height = "210px"
      ></KTCard>
    </div>
    <div class="col-md-6 col-xl-6">
      <KTCard
      color="danger"
        icon="/media/icons/duotune/abstract/abs025.svg"
        title="averageno"
        :description="hrReport.workerAvg"
        height = "210px"
      ></KTCard>
    </div>
      </div>
    </div>
    <div class="col-xl-6" >
      <div class="text-center">
        <h2 >{{ translate('departurestage') }}</h2>
      </div>
      <div class="row g-5 g-xl-8">
        <div class="col-md-6 col-xl-6">
      <KTCard
      color="success"
        icon="/media/icons/duotune/abstract/abs033.svg"
        title="noofflight"
        :description="maka.travelsCount"
        height = "210px"
      ></KTCard>
    </div>
    <div class="col-md-6 col-xl-6">
      <KTCard
      color="warning"
        icon="/media/icons/duotune/abstract/abs028.svg"
        title="noofpilgrims"
        :description="maka.pilCount"
        height = "210px"
      ></KTCard>
    </div>
    <div class="col-md-6 col-xl-6">
      <KTCard
      color="primary"
        icon="/media/icons/duotune/files/fil008.svg"
        title="totallabor"
        :description="maka.workers"
        height = "210px"
      ></KTCard>
    </div>
    <div class="col-md-6 col-xl-6">
      <KTCard
      color="info"
        icon="/media/icons/duotune/abstract/abs019.svg"
        title="averagetime"
        :description="maka.time_avg"
        height = "210px"
      ></KTCard>
    </div>
    <div class="col-md-6 col-xl-6">
      <KTCard
      color="danger"
        icon="/media/icons/duotune/abstract/abs025.svg"
        title="averageno"
        :description="maka.workerAvg"
        height = "210px"
      ></KTCard>
    </div>
      </div>
    </div>  
    </div>
  <div class="row g-5 g-xl-8">
    <div class="col-xl-12" v-if="lodaded4">
      <KTChartWidget3 widget-classes="card-xl-stretch mb-xl-8" 
       
            :data="lineChartData"></KTChartWidget3>
    </div>
    <div class="col-xl-12" v-if="lodaded">
      <ChartsWidget
        widget-classes="card-xl-stretch mb-xl-8"
        :height="400"
        :data = barChartData
      ></ChartsWidget>
    </div>
    <div class="col-xl-12" v-if="lodaded2">
      <ChartsWidget
        widget-classes="card-xl-stretch mb-xl-8"
        :height="400"
        :data = barChartData2
      ></ChartsWidget>
    </div>
    <div class="col-xl-12" v-if="lodaded3">
      <ChartsWidget
        widget-classes="card-xl-stretch mb-xl-8"
        :height="400"
        :data = barChartData3
      ></ChartsWidget>
    </div>
    
  </div>
  
  </template>
  <script lang="ts">
  import { defineComponent, onMounted, ref } from "vue";
  import ChartsWidget from "@/components/widgets/charts/Widget.vue";
  import KTChartWidget3 from "@/components/widgets/charts/Widget9.vue";
  import KTChartWidgetDonut from "@/components/widgets/charts/Donut.vue";
  import KTChartWidget1 from "@/components/widgets/charts/Widget1.vue";
  import KTCard from "@/components/cards/Card1.vue";
  import KTDonut from "@/components/widgets/charts/Donut.vue";
import ApiService from "@/core/services/ApiService";
import router from "@/router";
import { useI18n } from "vue-i18n";
   interface deliveddata{
    Answerswh: number;
HrconutOfNotDoneTasks: number;
HrconutOfPendingTasks: number;
Hrtasks : number;
HrtasksCompleted: number;
answershr: number;
emcompletedTasks: number;
emconutOfNotDoneTasks: number;
emconutOfPendingTasks: number;
emtasks: number;
   }

   interface hrReport{
    pilCount:number;
    time_avg:number;
    travelsCount : number;
     workerAvg:number;
 workers :number;
   }

   interface firtchar{
      name: string;
      max: string;
      min: string;
      step: string;
    }
  interface  secondchar {
    name:string;
    max:string;
    min: string;
    step: string;
  }


  export default defineComponent({
    name: "default",
    components: {
      KTCard,
      KTChartWidget3,
      KTChartWidget1,
      ChartsWidget,
      KTChartWidgetDonut,
      KTDonut
    },
    setup() {
      const { t, te } = useI18n();
        const deliveddata=ref({
            Answerswh: 0,
            HrconutOfNotDoneTasks: 0,
            HrconutOfPendingTasks: 0,
            Hrtasks : 0,
            HrtasksCompleted: 0,
            answershr: 0,
            emcompletedTasks: 0,
            emconutOfNotDoneTasks: 0,
            emconutOfPendingTasks: 0,
            emtasks: 0,
        });
      const firtchar=ref({
        name: "",
        max: "",
        min: "",
        step: "",
      });
      const secondchar=ref({
        name: "",
        max: "",
        min: "",
        step: "",
      });
      const lineChartData=ref({});
      const barChartData=ref({});
      const barChartData2=ref({});
      const barChartData3=ref({});
      const workerchartstatus=ref<Boolean>(false);
      const hrReport=ref<hrReport>({
        pilCount:0,
        time_avg:0,
        travelsCount : 0,
        workerAvg:0,
        workers :0,
      });
      const maka=ref<hrReport>({
        pilCount:0,
        time_avg:0,
        travelsCount : 0,
        workerAvg:0,
        workers :0,
      });
      const nationalityChart=ref({});
      const loadednatinality=ref<Boolean>(false);
      const lodaded=ref<Boolean>(false);
      const lodaded2=ref<Boolean>(false);
      const lodaded3=ref<Boolean>(false);
        const lodaded4=ref<Boolean>(false);

onMounted(() => {
        // title.value="تقرير اداء موظفي الموارد البشرية :";
     ApiService.get('formHrAnswerCount')
      .then(({ data }) => {
        //setAuth(data);
       barChartData3.value = {
        labels: data.template,
        datasets: [
            {
            label: `${data.Name}`,
            //borderColor: colors.themeColor1,
            // backgroundColor: colors.themeColor1_10,
            data: data.answers_count,
            borderWidth: 2
            }
        ]
        }
        lodaded3.value=true;
        })

        ApiService.get('reportsUserHr')
      .then(({ data }) => {
        //setAuth(data);
       barChartData.value = {
        labels: data.users,
        datasets: [
            {
            label: `${data.Name}`,
            //borderColor: colors.themeColor1,
            // backgroundColor: colors.themeColor1_10,
            data: data.Values,
            borderWidth: 2
            }
        ]
        }
        lodaded.value=true;
        })

        ApiService.get('nationalityChart')
      .then(({ data }) => {
        //setAuth(data);
        nationalityChart.value = {
        labels: data.data,
        datasets: [
            {
            // label: `${data.Name}`,
            //borderColor: colors.themeColor1,
            // backgroundColor: colors.themeColor1_10,
            data: data.Values,
            name: data.Name,
            borderWidth: 2
            }
        ]
        }
        loadednatinality.value=true;
        })
   
        
      ApiService.get("makkaReport")
      .then(({ data }) => {
        maka.value= data[0];
      })

        
         ApiService.get("reportshr").then((data) => {
            lineChartData.value={
                labels: data.data.Days,
                    datasets: [
                        {
                        label: `${data.data.Name}`,
                        //   borderColor: colors.themeColor1,
                        //   backgroundColor: colors.themeColor1_10,
                        data: data.data.Values,
                        borderWidth: 2
                        }
                    ]
            }
    //   lineChartData1.labels = data.Days;
    //   lineChartData1.datasets[0].data = data.Values;
    //   firtchar.max = data.max_Value;
    //   firtchar.min = data.minValue;
    //   firtchar.step = data.step;
    //   firtchar.name = data.Name;

      lodaded4.value = true;
    });
    ApiService.get("WorkersChart").then((data) => {
      barChartData2.value = {
  labels: data.data.data,
  datasets: [
    {
      label: `${data.data.name}`,
    //   borderColor: colors.themeColor1,
    //   backgroundColor: colors.themeColor1_10,
      data: data.data.Value,
      borderWidth: 2
    }
  ]
},
    //   this.lineChartData2.labels = data.users;
    //   this.lineChartData2.datasets[0].data = data.Values;
    //   this.secondchar.max = data.max_Value;
    //   this.secondchar.min = data.minValue;
    //   this.secondchar.step = data.step;
    //   this.secondchar.name = data.Name;

      lodaded2.value = true;
    });

    ApiService.get("showDashboard")
      .then(({ data }) => {
        deliveddata.value= data[0];
      })



      ApiService.get("hrReport")
      .then(({ data }) => {
        hrReport.value= data[0];
      })

      })
      
    


     const movetopage=(e)=>{
       router.push({ path: `${e}` });
     }

     const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };


      return {
        deliveddata,
        movetopage,
        firtchar,
        secondchar,
        barChartData,
        barChartData2,
        barChartData3,
        workerchartstatus,
        hrReport,
        nationalityChart,
        loadednatinality,
        lodaded,
        lodaded2,
        lodaded3,
        lodaded4,
        lineChartData,
        maka,
        translate
        
      };
    },
  });
  </script>
  