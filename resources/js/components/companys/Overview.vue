<template>
<v-layout row wrap >
    <v-flex v-for="company in companies" :key="company.id" class="xs12 md6 lg4 offset-lg-0 purple d-flex justify-space-around bedrijf">
        <router-link class="col-12 d-flex justify-space-around" :to="'/bedrijven' + company.id">
                <v-flex class="col-8">
                    <v-card-title
                        center
                        pa-0
                        class="body-2"
                        v-text="company.name"
                    ></v-card-title>
                      <v-card-subtitle
                        pa-3
                        class="body-2 verzoeken-teller"
                        v-text="company.tasks.length"
                      >
                      </v-card-subtitle>
                </v-flex>
                <v-flex class="col-4">
                    <v-avatar
                        class="ma-3 justify-self-end"
                        size="80"
                    >
                    <v-img v-bind:src="'/img/profile/' + company.photo"></v-img>
                    </v-avatar>
                </v-flex>
        </router-link>
    </v-flex>
</v-layout>
</template>
<script>
export default {
    data() {
        return {
            companies : {},
            tasks : {},
            newArray: {}
        }
    },
    computed: {
        openTasks()  {
            // return this.companies.filter((value, index) => value (tasks => tasks.status === "open"))
            // const newArray = this.companies.filter(tasks => tasks.status === "open")
        },
    },

    methods: {
        loadTasks(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/allTasks").then(({ data }) => (this.tasks = data.data));
                }
            },
        loadcompanies(){
            if(this.$gate.isAdminOrAuthor()){
                axios.get("api/company").then(({ data }) => (this.companies = data.data));
                }
            }
    },
    created() {
           this.loadcompanies();
           this.loadTasks();
           this.openTasks();
           console.log("jeh");
           }
}
</script>
<style lang="scss" scoped>
.bedrijf{
    display: flex;
    background-color: #35555d;
    border: 5px solid #2F484E;

    a{
        color: #fff;
        text-decoration: none;
    }
    :hover {
        opacity: 0.6;
        transition: 0.5s;
    }
    .verzoeken-teller{
        font-size: 28px;
        font-weight: 700;
        color: #D6E74D;
        font-family: 'Anton';
        padding-top: 10px;
    }
}
</style>
