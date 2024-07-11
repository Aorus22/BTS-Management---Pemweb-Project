import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {PageProps} from "@/types";
import React from "react";
import { useForm } from "@inertiajs/react";

const Page: React.FC<PageProps> = ({ auth, bts, kuesioner, pilihankuesioner }) => {
    const { data, setData, post, errors, clearErrors } = useForm({
        id_bts: null,
        tahun: null,
        tanggal_kunjungan: null,
        jawaban: {} as { [key: number]: number | string }
    });

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        const { name, value } = e.target;
        clearErrors(name as 'id_bts' | 'tahun' | 'tanggal_kunjungan' | 'jawaban');
        setData(name as 'id_bts' | 'tahun' | 'tanggal_kunjungan' | 'jawaban', value);
    };

    const handleJawabanChange = (id_kuesioner: number, id_pilihan: number) => {
        setData('jawaban', { ...data.jawaban, [id_kuesioner]: id_pilihan });
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        post('/monitoring');
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
                            value={data.id_bts || ""}
                            onChange={handleInputChange}
                            className={`shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline text-lg ${
                                errors.id_bts ? 'border-red-500' : ''
                            }`}
                        >
                            <option value="">Pilih BTS</option>
                            {(bts as []).map((btsItem: any) => (
                                <option key={btsItem.id} value={btsItem.id}>
                                    {btsItem.nama}
                                </option>
                            ))}
                        </select>
                        {errors.id_bts && (
                            <p className="text-red-500 text-sm mt-1">{errors.id_bts}</p>
                        )}
                    </div>

                    <div className="mb-4">
                        <label className="block text-gray-700 text-lg font-bold mb-2" htmlFor="tahun">
                            Tahun
                        </label>
                        <input
                            type="number"
                            name="tahun"
                            value={data.tahun || ""}
                            onChange={handleInputChange}
                            className={`shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline text-lg ${
                                errors.tahun ? 'border-red-500' : ''
                            }`}
                        />
                        {errors.tahun && (
                            <p className="text-red-500 text-sm mt-1">{errors.tahun}</p>
                        )}
                    </div>

                    <div className="mb-16">
                        <label className="block text-gray-700 text-lg font-bold mb-2" htmlFor="tanggal_kunjungan">
                            Tanggal Kunjungan
                        </label>
                        <input
                            type="datetime-local"
                            name="tanggal_kunjungan"
                            value={data.tanggal_kunjungan || ""}
                            onChange={handleInputChange}
                            className={`shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline text-lg ${
                                errors.tanggal_kunjungan ? 'border-red-500' : ''
                            }`}
                        />
                        {errors.tanggal_kunjungan && (
                            <p className="text-red-500 text-sm mt-1">{errors.tanggal_kunjungan}</p>
                        )}
                    </div>

                    <div>
                        <div className="mb-8 py-4 bg-gradient-to-b from-gray-700 to-gray-800 rounded-lg shadow-md text-center">
                            <p className="text-3xl font-semibold text-white">KUESIONER</p>
                        </div>
                        {(kuesioner as []).map((item: any) => (
                            <div key={item.id} className="mb-8 p-4 bg-white rounded-lg shadow-md">
                                <p className="text-lg font-semibold mb-4 text-gray-700">{item.pertanyaan}</p>
                                <div className="space-y-2">
                                    {(pilihankuesioner as [])
                                        .filter((pilihan: any) => pilihan.id_kuesioner === item.id)
                                        .map((pilihan: any) => (
                                            <label key={pilihan.id} className="block cursor-pointer">
                                                <input
                                                    type="radio"
                                                    name={`kuesioner_${item.id}`}
                                                    value={pilihan.id}
                                                    checked={data.jawaban[item.id] === pilihan.id}
                                                    onChange={() => handleJawabanChange(item.id, pilihan.id)}
                                                    className="mr-2 accent-blue-600"
                                                />
                                                <span className="text-gray-600">{pilihan.pilihan_jawaban}</span>
                                            </label>
                                        ))}
                                </div>
                            </div>
                        ))}
                    </div>

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

export default Page;
