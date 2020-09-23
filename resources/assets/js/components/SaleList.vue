<template>
    <div class="ui segment">
        <div class="ui search">
            <el-row :gutter="20">
                <el-col :span="6">
                    <el-dropdown split-button @command="handlePerPage">
                        {{ perPage }}/Page
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item :command="10">10</el-dropdown-item>
                            <el-dropdown-item :command="20">20</el-dropdown-item>
                            <el-dropdown-item :command="50">50</el-dropdown-item>
                            <el-dropdown-item :command="100">100</el-dropdown-item>
                            <el-dropdown-item :command="200">200</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </el-col>
                <el-col :span="6" :offset="12">
                    <el-input placeholder="Please input" v-model="search" class="input-with-select" id="search">
                        <el-button slot="append" icon="el-icon-search" @click="searchItem(1)"></el-button>
                    </el-input>
                </el-col>
            </el-row>

            <div class="results"></div>
        </div>
        <div style="height: 20px">

        </div>
        <div class="table-responsive">
            <el-table
                v-loading="loading"
                border
                :data="items"
                style="width: 100%">
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="date"
                    label="Date">
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="code"
                    label="Invoice">
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="customer"
                    label="Customer">
                    <template slot-scope="scope">
                        <template v-if="scope.row.customer == null"> N/A </template>
                        <template v-else> {{ scope.row.customer.name }} </template>
                    </template>
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="total"
                    width="100"
                    label="Total">
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="profit"
                    width="100"
                    label="Profit">
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    label="Action">
                    <template slot-scope="scope">
                        <a :href="'/sales/' + scope.row.id + '/print'" ><i class="eye icon"></i></a>

                        <a :href="'/sales/' + scope.row.id + '/edit'"><i class="edit icon"></i></a>

                        <a @click.prevent="$deletefun('/api/sales', scope.row.id)"><i class="red trash icon"></i> </a>
                    </template>
                </el-table-column>
            </el-table>
            <div style="height: 20px"></div>
            <el-pagination
                :disabled="loading"
                :page-size="perPage"
                background
                layout="prev, pager, next"
                :total="total"
                @current-change="handleCurrentChange"
            >
            </el-pagination>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            search: '',
            total: 0,
            loading: false,
            perPage: 10
        }
    },
    mounted() {
        this.getItemList(1);
    },
    methods: {
        getItemList(page) {
            this.loading = true;
            axios.get('/api/sales?search=' + this.search +"&per-page=" + this.perPage +"&page=" + page)
                .then(response => {
                    this.items = response.data.data;
                    this.total = response.data.meta.total;
                    this.loading = false;
                });
        },
        handleCurrentChange(page) {
            this.getItemList(page)
        },
        searchItem() {
            this.getItemList(1);
        },
        handlePerPage(command) {
            this.perPage = command
            this.getItemList(1);
        }
    }
}
</script>
