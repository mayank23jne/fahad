<template>
    <!--begin::Charts Widget 1-->
    <div class="card" :class="widgetClasses">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column text-center"
        @click="data.datasets[0].template_id || data.datasets[0].company_id ? gotopage(data.datasets[0].template_id, data.datasets[0].company_id) : ''">
          <span class="card-label fw-bold fs-3 mb-1">{{data.datasets[0].name}}</span>

        </h3>
        <!--end::Title-->
  
        <!--begin::Toolbar-->
        <!-- <div class="card-toolbar"> -->
          <!--begin::Menu-->
          <!-- <button
            type="button"
            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
            data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-end"
            data-kt-menu-flip="top-end"
          >
            <span class="svg-icon svg-icon-2">
              <inline-svg src="/media/icons/duotune/general/gen024.svg" />
            </span>
          </button> -->
          <!-- <Dropdown1></Dropdown1> -->
          <!--end::Menu-->
        <!-- </div> -->
        <!--end::Toolbar-->
      </div>
      <!--end::Header-->
  
      <!--begin::Body-->
      <div class="card-body">
        <!--begin::Chart-->
        <apexchart
          ref="chartRef"
          type="donut"
          :options="chart"
          :series="series"
          :height="height"
         
        ></apexchart>
        <!-- @dataPointSelection="data.datasets[0].template_id || data.datasets[0].id ? gotopage(data.datasets[0].template_id, data.datasets[0].id) : ''" -->
        <!--end::Chart-->
      </div>
      <!--end::Body-->
    </div>
    <!--end::Charts Widget 1-->
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, computed, watch, onBeforeMount } from "vue";
  import { useThemeStore } from "@/stores/theme";
  import type { ApexOptions } from "apexcharts";
  import Dropdown1 from "@/components/dropdown/Dropdown1.vue";
  import { getCSSVariableValue } from "@/assets/ts/_utils";
  import type VueApexCharts from "vue3-apexcharts";
   import router from "@/router";
  
  export default defineComponent({
    name: "widget-1",
    props: {
      widgetClasses: String,
      height: Number,
      data:{} as any,
    },
    components: {
      Dropdown1,
    },
    setup(props) {
      const chartRef = ref<typeof VueApexCharts | null>(null);
      let chart: ApexOptions = {};
      const store = useThemeStore();
        let sdata =  JSON.parse(JSON.stringify(props.data.datasets[0].data));
        const numbers = sdata.map((n) => {
         return parseInt(n, 10);
         });

      const series = numbers ;

      const themeMode = computed(() => {
        return store.mode;
      });
  
      onBeforeMount(() => {
        Object.assign(chart, chartOptions(props.data));
      });
  
      const refreshChart = () => {
        if (!chartRef.value) {
          return;
        }
  
        Object.assign(chart, chartOptions(props.data));
  
        chartRef.value.refresh();
      };
  
      watch(themeMode, () => {
        refreshChart();
      });
  
      
      const gotopage=(template_id, company_id) =>{
        if(company_id){
          router.push({
        name: 'unitsstatusreport',
        params: { 
          text:'company',
          t_id:company_id },
      })
        }else{
          router.push({
        name: 'unitsstatusreport',
        params: { 
          text:'template', t_id:template_id },
      })
        }
        
      }

      return {
        chart,
        series,
        chartRef,
        gotopage
      };
    },
  });
  
  const chartOptions = (data): ApexOptions => {
    const labelColor = getCSSVariableValue("--kt-gray-500");
    const borderColor = getCSSVariableValue("--kt-gray-200");
    const baseColor = getCSSVariableValue("--kt-primary");
    const secondaryColor = getCSSVariableValue("--kt-gray-300");
  
    return {
        chart: {
              width: 380,
              type: 'donut',
              events: {
                    click(event, chartContext, config) {
                    }
                },  
            },
            plotOptions: {
              pie: {
                startAngle: -90,
                endAngle: 270,
                
              }
            },
             
            labels: data.labels,
            colors: [ 'rgb(0, 227, 150)', 'rgb(255, 69, 96)',],
            dataLabels: {
              enabled: true
            },
            fill: {
              type: 'solid',
              colors: ['rgb(0, 227, 150)', 'rgb(255, 69, 96)']
            },
            legend: {
              formatter: function(val, opts) {
                return data.labels[opts.seriesIndex]
              }
            },
            
            // title: {
            //   text: 'Gradient Donut with custom Start-angle'
            // },
    //         tooltip: {
    //     style: {
    //       fontSize: "12px",
    //     },
    //     y: {
    //       formatter: function (val) {
    //         return "$" + val + " thousands";
    //       },
    //     },
    //   },
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: 200
                },   
                legend: {
                  position: 'bottom'
                }
              }
            }]
    //   plotOptions: {
    //     bar: {
    //       horizontal: false,
    //       columnWidth: "30%",
    //       borderRadius: 5,
    //     },
    //   },
    //   legend: {
    //     show: false,
    //   },
    //   dataLabels: {
    //     enabled: false,
    //   },
    //   stroke: {
    //     show: true,
    //     width: 2,
    //     colors: ["transparent"],
    //   },
    //   xaxis: {
    //     categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    //     axisBorder: {
    //       show: false,
    //     },
    //     axisTicks: {
    //       show: false,
    //     },
    //     labels: {
    //       style: {
    //         colors: labelColor,
    //         fontSize: "12px",
    //       },
    //     },
    //   },
    //   yaxis: {
    //     labels: {
    //       style: {
    //         colors: labelColor,
    //         fontSize: "12px",
    //       },
    //     },
    //   },
    //   fill: {
    //     opacity: 1,
    //   },
    //   states: {
    //     normal: {
    //       filter: {
    //         type: "none",
    //         value: 0,
    //       },
    //     },
    //     hover: {
    //       filter: {
    //         type: "none",
    //         value: 0,
    //       },
    //     },
    //     active: {
    //       allowMultipleDataPointsSelection: false,
    //       filter: {
    //         type: "none",
    //         value: 0,
    //       },
    //     },
    //   },
    //   tooltip: {
    //     style: {
    //       fontSize: "12px",
    //     },
    //     y: {
    //       formatter: function (val) {
    //         return "$" + val + " thousands";
    //       },
    //     },
    //   },
    //   colors: [baseColor, secondaryColor],
    //   grid: {
    //     borderColor: borderColor,
    //     strokeDashArray: 4,
    //     yaxis: {
    //       lines: {
    //         show: true,
    //       },
    //     },
    //   },
    };
  };
  </script>
  