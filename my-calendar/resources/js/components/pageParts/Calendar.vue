<template>
    <div>
        <v-sheet height="100vh">
            <v-calendar
                v-model="value"
                :events="events"
                @change="fetchEvents"
            ></v-calendar>
        </v-sheet>
    </div>
</template>

<script>
export default {
    name: 'Calendar',
    data: () => ({
        value: new Date('2022/01/12'),
        events: [],
    }),
    methods: {
        fetchEvents() {
            axios.get('/api/events')
                .then(response => {
                    this.events = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>