import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from "@/types";
import React, { useState } from "react";
import DynamicForm from "@/Components/DynamicForm";
import { usePage } from "@inertiajs/react";

const Page: React.FC<PageProps> = ({ auth, monitoring, jawaban }) => {
    const [data1, setData1] = useState(monitoring);
    const [data2, setData2] = useState(jawaban as any[]);

    const pathname = usePage().url.split('/').slice(0, 3).join('/');

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Monitoring</h2>}
        >
            <div className="p-4">
                <DynamicForm isNewForm={false} data={data1 as object} />
            </div>

            <div className="p-4">
                <div className="bg-gradient-to-b from-gray-100 to-gray-300 rounded-lg shadow-md py-10 px-24">
                    <h3 className="text-lg font-semibold mb-4 text-gray-800">Jawaban Kuesioner</h3>
                    <div className="space-y-4">
                        {data2.map((item, index) => (
                            <div key={index} className="bg-white p-4 rounded-lg shadow-md">
                                <p className="font-semibold text-gray-700 mb-2">{item.id_kuesioner}</p>
                                <p className="text-gray-600">{item.id_pilihan_kuesioner}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Page;
