import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import React, {useState} from "react";
import DynamicForm from "@/Components/DynamicForm";
import kuesioner from "@/Pages/Kuesioner/index";
import DynamicTabel from "@/Components/DynamicTabel";
import {usePage} from "@inertiajs/react";

const Page: React.FC<PageProps> = ({ auth, kuesioner, pilihan_kuesioner }) => {
    const [data1, setData1] = useState(kuesioner)
    const [data2, setData2] = useState(pilihan_kuesioner)

    const pathname = usePage().url.split('/').slice(0, 3).join('/');

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Kuesioner</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm data={data1 as object} isNewForm={false}  />

                <div className="mt-10 py-4 bg-gradient-to-b from-gray-700 to-gray-800 rounded-lg shadow-md text-center">
                    <p className="text-3xl font-semibold text-white">Pilihan Jawaban</p>
                </div>

                <DynamicTabel data={data2 as []} customPath={`${pathname}/data-pilihan-kuesioner`} />
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
