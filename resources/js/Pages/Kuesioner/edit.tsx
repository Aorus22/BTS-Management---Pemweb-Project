import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import React from "react";
import DynamicForm from "@/Components/DynamicForm";
import DynamicTabel from "@/Components/DynamicTabel";
import {usePage} from "@inertiajs/react";

const Page: React.FC<PageProps> = ({ auth, kuesioner, pilihan_kuesioner }) => {
    const pathname = usePage().url.split('/').slice(0, 3).join('/');

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Kuesioner</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={kuesioner as object} isNewForm={false}  />

                <div className="mt-10 py-4 bg-gradient-to-b from-gray-700 to-gray-800 rounded-lg shadow-md text-center">
                    <p className="text-3xl font-semibold text-white">Pilihan Jawaban</p>
                </div>

                <DynamicTabel data={pilihan_kuesioner as []} customPath={`${pathname}/data-pilihan-kuesioner`} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
