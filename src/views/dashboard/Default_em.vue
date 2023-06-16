<template>
  <div class="row g-6 g-xl-9 mb-xl-8">
    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
      color="primary"
      icon="/media/icons/duotune/abstract/abs024.svg"
        title="totalrating"
        :description="deliveddata.Answerswh"
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
        title="emergencytask"
        :description="deliveddata.emtasks"
        date="May 10, 2021"
        budget="$36,400.00"
      
      ></KTCard>
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
      @click="movetopage('/apps/reports/completedtask/em')"
      color="success"
        status="Completed"
        status-data-badge-color="badge-light-success"
        :progress="100"
        icon="/media/icons/duotune/files/fil008.svg"
        title="completedtaskem"
        :description="deliveddata.emcompletedTasks"
        date="Mar 14, 2021"
        budget="$605,100.00"
        height = "207px"
      ></KTCard>
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
      @click="movetopage('/apps/reports/pendingtask/em')"
        status="Pending"
        :progress="60"
        status-data-badge-color="badge-light"
        color="warning"
        icon="/media/icons/duotune/abstract/abs022.svg"
        title="pendingtaskem"
        :description="deliveddata.emconutOfPendingTasks"
        budget="$36,400.00"
        
      ></KTCard>
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
      @click="movetopage('/apps/reports/notcompletedtask/em')"
        status="In Progress"
        :progress="40"
        color="danger"
        icon="/media/icons/duotune/arrows/arr015.svg"
        title="notcompletedtaskem"
        :description="deliveddata.emconutOfNotDoneTasks"
        date="May 10, 2021"
        budget="$36,400.00"
        
      ></KTCard>
    </div>
    <!--end::Col-->

  </div>
  <div class="row g-5 g-xl-8">
    <div class="col-xl-12" v-if="lodaded">
      <KTChartWidget3 widget-classes="card-xl-stretch mb-xl-8" 
       
            :data="barChartData"></KTChartWidget3>
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
     <!-- <div class="separator mb-5"></div>
  <div class="row">
    <div class="col-md-12">
    <div  class="card card-flush pt-3 mb-0 mb-lg-10 card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2">
      <div class="card-body pt-0 mt-5">
        <p class="card-text font-weight-semibold mb-0 text-center mt-5 ">
              اجمالى التقيمات
            </p>
            <div class="fs-2hx fw-bold text-center">{{ deliveddata.Answerswh }}</div>
           
      </div>
    </div>
</div>
<div class="col-md-6">
    <div  class="card card-flush pt-3 mb-0 mb-lg-10 card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2">
      <div class="card-body pt-0 mt-5">
        <p class="card-text font-weight-semibold mb-0 text-center">
              المهام الخاصة بالطوارئ
            </p>
            <div class="fs-2hx fw-bold text-center">{{ deliveddata.emtasks }}</div>
          
      </div>
    </div>
</div>
<div class="col-md-6">
    <div  class="card card-flush pt-3 mb-0 mb-lg-10 card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2"
    @click="movetopage('compeletetask/em')">
      <div class="card-body pt-0 mt-5">
        <p class="card-text font-weight-semibold mb-0 text-center">
              مهام الطوارئ المكتملة
            </p>
          
            <div class="fs-2hx fw-bold text-center">{{ deliveddata.emcompletedTasks }}</div>
      </div>
    </div>
</div>
<div class="col-md-6">
    <div  class="card card-flush pt-3 mb-0 mb-lg-10 card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2"
    @click="movetopage('pendingtask/em')">
      <div class="card-body pt-0 mt-5">
        <p class="card-text font-weight-semibold mb-0 text-center">
              مهام الطوارئ المعلقة
            </p>
            <div class="fs-2hx fw-bold text-center">{{ deliveddata.emconutOfPendingTasks }}</div>
           
      </div>
    </div>
</div>
<div class="col-md-6">
    <div  class="card card-flush pt-3 mb-0 mb-lg-10 card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2"
    @click="movetopage('notcompletedtask/em')">
      <div class="card-body pt-0 mt-5">
        <p class="card-text font-weight-semibold mb-0 text-center">
              مهام الطوارئ المرفوضة
            </p>
            <div class="fs-2hx fw-bold text-center">{{ deliveddata.emconutOfNotDoneTasks }}</div>
          
      </div>
    </div>
</div>
<div class="col-md-12">
  <h4 style="font-weight: bold; margin-bottom: 5px" class="card-subtitle">
          {{ firtchar.name }}
        </h4>
      
      <KTChartWidget3
        widget-classes="card-xxl-stretch mb-5 mb-xl-10"
        :max="firtchar.max"
            :min="firtchar.min"
            :step="firtchar.step"
            :data="lineChartData1"
      ></KTChartWidget3>
    
</div>
<div class="col-md-12">
  <h4 style="font-weight: bold; margin-bottom: 5px" class="card-subtitle">
          {{ firtchar.name }}
        </h4>
      
      <KTChartWidget1 
        widget-classes="card-xxl-stretch mb-5 mb-xl-10"
        :data=" barChartData3" 
        shadow
      ></KTChartWidget1>
    
</div>
</div> -->
  </template>
  <script lang="ts">
  import { defineComponent, onMounted, ref } from "vue";
  import ChartsWidget from "@/components/widgets/charts/Widget.vue";
  import KTChartWidget3 from "@/components/widgets/charts/Widget9.vue";
  import KTChartWidget1 from "@/components/widgets/charts/Widget1.vue";
  import KTCard from "@/components/cards/Card1.vue";
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
    name: "default_em",
    components: {
      KTCard,
      KTChartWidget3,
      KTChartWidget1,
      ChartsWidget
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
      const barChartData=ref({});
      const barChartData2=ref({});
      const barChartData3=ref({});
      const workerchartstatus=ref<Boolean>(false);
      const hrReport=ref("");
      const nationalityChart=ref("");
      const loadednatinality=ref<Boolean>(false);
      const lodaded=ref<Boolean>(false);
      const lodaded2=ref<Boolean>(false);
      const lodaded3=ref<Boolean>(false);


//         axios.get('formReportWheresCount').then((res)=>
// {
//    this.barChartData3 = {
//   labels: res.data.template,
//   datasets: [
//     {
//        label: `${res.data.Name}`,
//       borderColor: colors.themeColor1,
//       backgroundColor: colors.themeColor1_10,
//       data: res.data.answers_count,
//       borderWidth: 2
//     }
//   ]
// },

//       this.lodaded3 = true;

// })

const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };

onMounted(() => {
        // title.value="تقرير اداء موظفي الموارد البشرية :";
     ApiService.get('formReportWheresCount')
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

         ApiService.get("reportswh").then((data) => {
            barChartData.value={
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

      lodaded.value = true;
    });
    ApiService.get("reportsUserWheres").then((data) => {
      barChartData2.value = {
  labels: data.data.users,
  datasets: [
    {
      label: `${data.data.Name}`,
    //   borderColor: colors.themeColor1,
    //   backgroundColor: colors.themeColor1_10,
      data: data.data.Values,
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

      })
      .catch(({ response }) => {
        //setError(response.data.errors);
      });
     // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
    });


     const movetopage=(e)=>{
       router.push({ path: `${e}` });
     }

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
        translate,
      };
    },
  });
  </script>
  