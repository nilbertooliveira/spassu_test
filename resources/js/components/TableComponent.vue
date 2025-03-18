<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <!-- Único <tr> -->
                            <tr>
                                <!-- Cada header é um <th> -->
                                <th v-for="(header, headerIndex) in headers" :key="headerIndex">
                                    {{ header }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Linhas da tabela -->
                            <tr v-for="(row, rowIndex) in rows" :key="rowIndex">
                                <!-- Cada valor na linha -->
                                <td v-for="(value, collIndex) in row" :key="collIndex">
                                    {{ value }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TableComponent',
    props: {
        headers: {
            type: Array,
            required: true
        },
        rows: {
            type: Array,
            required: true
        }
    },

    mounted() {
        console.log('Component mounted.');
    }
};
</script>
