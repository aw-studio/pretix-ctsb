<template>
    <div class="text-center text-white">
        <h1 class="text-xl font-medium leading-tight tracking-wide">
            Kostenloser<br />
            Corona-Bürgertest
        </h1>
        <div class="flex flex-col items-center my-8 space-y-2">
            <Tag>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    class="w-4 h-4 mr-2 fill-current"
                >
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"
                    />
                </svg>
                vollständig digitalisiert
            </Tag>
            <Tag>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    class="w-4 h-4 mr-2 fill-current"
                >
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z"
                    />
                </svg>
                Testergebnis per E-Mail
            </Tag>
            <Tag>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    class="w-4 h-4 mr-2 fill-current"
                >
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"
                    />
                    <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                </svg>
                15-20 Minuten
            </Tag>
        </div>
    </div>
</template>

<script setup lang="ts">
import Tag from '@/components/Tag.vue';
</script>
