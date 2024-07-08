import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import DynamicForm, {Dropdown} from "@/Components/DynamicForm";
import React, {useEffect, useState} from "react";
import KuesionerForm, {JawabanKuesioner} from "@/Components/KuesionerForm";
import {Kuesioner, PilihanKuesioner} from "@/Components/KuesionerForm";
import {useForm} from "@inertiajs/react";

const Page: React.FC<PageProps> = ({ auth, bts, kuesioner, pilihankuesioner}) => {
    const [data, setData] = useState({
        id_bts: "",
        tahun: 2024,
        tanggal_kunjungan: new Date().toISOString().slice(0, 16)
    })

    const dropdown: Dropdown = {
        id_bts: bts as[],
    }

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        const { name, value } = e.target;
        setData(prevData => ({
            ...prevData,
            [name]: value
        }));
    };

    const [jawaban, setJawaban] = useState<{ [key: number]: number }>({});


    const {data: submitData, setData: setSubmitData, post} = useForm<{monitoring: any, jawaban: any[]}>({
        monitoring: {},
        jawaban: []
    })

    useEffect(() => {
        const jawabanData = Object.keys(jawaban).map(id_kuesioner => ({
            id_kuesioner: Number(id_kuesioner),
            id_pilihan_kuesioner: jawaban[Number(id_kuesioner)]
        }));
        setSubmitData('jawaban', jawabanData)
    }, [jawaban])

    useEffect(() => {
        setSubmitData('monitoring', data)
    }, [data])

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault()
        post('/monitoring')
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Monitoring</h2>}
        >
            <div className="py-4 px-48">
                <div className="bg-gradient-to-b from-white to-gray-50 rounded-xl p-12 mt-4">
                    <div className="mb-4">
                        <label className="block text-gray-700 text-lg font-bold mb-2" htmlFor="id_bts">
                            Pilih BTS
                        </label>
                        <select
                            name="id_bts"
                            value={data.id_bts}
                            onChange={handleInputChange}
                            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline text-lg"
                        >
                            <option value="">Pilih BTS</option>
                            {dropdown.id_bts.map(btsItem => (
                                <option key={btsItem.id} value={btsItem.id}>
                                    {btsItem.nama}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="mb-4">
                        <label className="block text-gray-700 text-lg font-bold mb-2" htmlFor="tahun">
                            Tahun
                        </label>
                        <input
                            type="number"
                            name="tahun"
                            value={data.tahun}
                            onChange={handleInputChange}
                            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline text-lg"
                        />
                    </div>

                    <div className="mb-16">
                        <label className="block text-gray-700 text-lg font-bold mb-2" htmlFor="tanggal_kunjungan">
                            Tanggal Kunjungan
                        </label>
                        <input
                            type="datetime-local"
                            name="tanggal_kunjungan"
                            value={data.tanggal_kunjungan}
                            onChange={handleInputChange}
                            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline text-lg"
                        />
                    </div>

                    <KuesionerForm kuesioner={kuesioner as Kuesioner[]}
                                   pilihan_kuesioner={pilihankuesioner as PilihanKuesioner[]}
                                   jawaban={jawaban}
                                   setJawaban={setJawaban}
                    />

                    <div className="w-full flex justify-center item-center">
                        <button
                            type="submit"
                            onClick={handleSubmit}
                            className="px-64 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded text-lg"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Page
