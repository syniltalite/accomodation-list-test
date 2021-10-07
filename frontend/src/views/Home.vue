<template>
    <div id = "app">
        <div class="grid grid-cols-2 gap-7">
            <div> 
                <h2>Filter By Suburb:</h2>
                <select v-model="suburbFilter" @change="changeSuburb($event)">
                    <option value="">Please select one</option>
                    <option
                    v-for="suburb in suburbs"
                    :key="suburb.suburbId"
                    :value="suburb.Name"
                    >
                    {{ suburb.Name }}
                    </option>
                </select>
            </div>
            <div>
                <h2>Filter By Area:</h2>
                <select v-model="areaFilter" @change="changeArea($event)">
                    <option value="">Please select one</option>
                    <option
                    v-for="area in areas"
                    :key="area.AreaId"
                    :value="area.AreaId"
                    >
                    {{ area.Name }}
                    </option>
                </select>
            </div>
        </div>
        <h1> Product List </h1>
        <ul>
            <li v-for="p in products" v-bind:key="p.id">
                <div class="grid grid-cols-1 gap-3">
                    <div class="place-self-center"><img :src="p.productImage" alt="..."/></div>
                    <div>{{p.productName}}</div>
                    <div>Address: {{p.addresses.[0].address_line + ' ' + p.addresses.[0].address_line2}}</div>
                    <div>Suburb/City: {{p.addresses.[0].city}}</div>
                    <div>State: {{p.addresses.[0].state}}</div>
                    <div>Postcode: {{p.addresses.[0].postcode}}</div>
                    <div>Area: {{p.addresses.[0].area.[0]}}</div>
                    <div>{{p.productDescription}}</div>
                    <hr>
                    <div></div>
                </div>
            </li>
        </ul>
        <VueTailwindPagination :current="page" :total="total" :per-page="pageLimit" @page-changed="pageChange($event)"/>
    </div>
</template>
<script>
import axios from "axios";
import VueTailwindPagination from "@ocrv/vue-tailwind-pagination";
const baseURL = "http://localhost:8001/";
export default {
    name: "Home",
    components: {
        VueTailwindPagination,
    },
    data(){
        return{
            products:[],
            page: 1,
            pageLimit: 10,
            total: 100,
            suburbs: [],
            areas: [],
            suburbFilter: null,
            areaFilter: null,
            dataFilters: {
                'pge': this.page,
                'ct': this.suburbFilter,
                'ar': this.areaFilter
            },
        };
    },
    methods:{
        pageChange(pageNo){
            this.page = pageNo;
            this.dataFilters = {
                'pge': this.page,
                'ct': this.suburbFilter,
                'ar': this.areaFilter
            };
            this.getData()
        },
        async getData(){
            try{
                const res = await axios({
                    'method': 'post',
                    'url': baseURL+'api/search',
                    'data':{
                        'filters': this.dataFilters
                    }
                });
                this.products = res.data.data.products;
                this.pageLimit = parseInt(res.data.data.pageLimit);
                this.total = parseInt(res.data.data.numberOfResults);
            } catch(e){
                console.error(e);
            }
        },
        async getSuburbs(){
            try{
                const res = await axios({
                    'method': 'post',
                    'url': baseURL+'api/suburbList',
                });
                this.suburbs = res.data.data.Suburbs;
            } catch(e){
                console.error(e);
            }
        },
        async getAreas(){
            try{
                const res = await axios({
                    'method': 'post',
                    'url': baseURL+'api/areaList',
                });
                this.areas = res.data.data;
            } catch(e){
                console.error(e);
            }
        },
        changeSuburb (event) {
            this.page = 1;
            this.dataFilters = {
                'pge': this.page,
                'ct': event.target.value,
                'ar': this.areaFilter
            };
            this.getData();
        },
        changeArea (event) {
            this.page = 1;
            this.dataFilters = {
                'pge': this.page,
                'ct': this.suburbFilter,
                'ar': event.target.value
            };
            this.getData();
        }
    },
    mounted(){
        this.page = 1;
        this.getData();
        this.getSuburbs();
        this.getAreas();
    }
};
</script>
