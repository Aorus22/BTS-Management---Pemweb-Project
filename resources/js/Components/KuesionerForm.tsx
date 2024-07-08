import React, { useState } from 'react';
import { useForm, usePage } from '@inertiajs/react';

export type Kuesioner = {
    id: number;
    pertanyaan: string;
};

export type PilihanKuesioner = {
    id: number;
    id_kuesioner: number;
    pilihan_jawaban: string;
};

export type JawabanKuesioner = {
    id_kuesioner: number;
    id_pilihan_kuesioner: number;
};

interface KuesionerFormProps {
    kuesioner: Kuesioner[];
    pilihan_kuesioner: PilihanKuesioner[];
    jawaban: { [key: number]: number };
    setJawaban: React.Dispatch<React.SetStateAction<{ [key: number]: number }>>;
}

const KuesionerForm: React.FC<KuesionerFormProps> = ({ kuesioner, pilihan_kuesioner, jawaban, setJawaban }) => {
    const handleChange = (id_kuesioner: number, id_pilihan: number) => {
        setJawaban(prevJawaban => ({
            ...prevJawaban,
            [id_kuesioner]: id_pilihan
        }));
    };

    return (
        <div className="bg-gradient-to-b from-gray-100 to-gray-300 p-8 rounded-lg shadow-lg">
            {kuesioner.map((item) => (
                <div key={item.id} className="mb-8 p-4 bg-white rounded-lg shadow-md">
                    <p className="text-lg font-semibold mb-4 text-gray-700">{item.pertanyaan}</p>
                    <div className="space-y-2">
                        {pilihan_kuesioner
                            .filter((pilihan) => pilihan.id_kuesioner === item.id)
                            .map((pilihan) => (
                                <label key={pilihan.id} className="block cursor-pointer">
                                    <input
                                        type="radio"
                                        name={`kuesioner_${item.id}`}
                                        value={pilihan.id}
                                        checked={jawaban[item.id] === pilihan.id}
                                        onChange={() => handleChange(item.id, pilihan.id)}
                                        className="mr-2 accent-blue-600"
                                    />
                                    <span className="text-gray-600">{pilihan.pilihan_jawaban}</span>
                                </label>
                            ))}
                    </div>
                </div>
            ))}
        </div>
    );
};

export default KuesionerForm;
