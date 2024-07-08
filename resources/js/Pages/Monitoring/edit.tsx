import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from "@/types";
import React, { useState } from "react";
import DynamicForm from "@/Components/DynamicForm";
import { usePage } from "@inertiajs/react";

const Page: React.FC<PageProps> = ({ auth, monitoring, jawaban }) => {
    const [data1, setData1] = useState(monitoring);
    const [data2, setData2] = useState(jawaban as any[]);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Monitoring</h2>}
        >
            <div className="py-4 px-48">
                <DynamicForm isNewForm={false} data={data1 as object} />
            </div>

            <div className="py-4 px-48">
                <div className="bg-white rounded-lg shadow-md py-10 px-24">
                    <div
                        className="mb-8 py-4 bg-gradient-to-b from-gray-700 to-gray-800 rounded-lg shadow-md text-center">
                        <p className="text-2xl font-semibold text-white">JAWABAN KUESIONER</p>
                    </div>
                    <div className="space-y-4">
                        {data2.map((item, index) => (
                            <div key={index} className="bg-white p-4 rounded-lg shadow-md">
                                <p className="text-lg text-gray-700 mb-2">{item.id_kuesioner}</p>
                                <p className="font-semibold text-gray-600 text-xl">{item.id_pilihan_kuesioner}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Page;
