import axios from "axios";
import {Link, usePage, router} from "@inertiajs/react";
import React from "react";

interface TableProps {
    data: Array<{ [key: string]: any }>;
}

const formatHeader = (key: string) => {
    return key.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
};

const formatDate = (dateString: string) => {
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

const Table: React.FC<TableProps> = ({ data }) => {
    const pathname = usePage().url

    const handleDelete = (id: any) => {
        router.delete(`${pathname}/${id}`)
    };

    if (data.length === 0) {
        return <p className="text-center p-4">Tidak ada data yang tersedia.</p>;
    }

    return (
        <>
            <Link href={`${pathname}/create`} className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-4">
                Tambah
            </Link>
            <table className="mt-6 table-auto w-full border-collapse border border-gray-300">
                <thead>
                <tr className="bg-gray-100">
                    <th className="px-4 py-2 border border-gray-300">No</th>
                    {Object.keys(data[0]).map((key, index) => (
                        <th key={index} className="px-4 py-2 border border-gray-300">{formatHeader(key)}</th>
                    ))}
                    <th className="px-4 py-2 border border-gray-300">Actions</th>
                </tr>
                </thead>
                <tbody>
                {data.map((item, index) => (
                    <tr key={index} className="bg-white">
                        <td className="border px-4 py-2 border-gray-300">{index + 1}</td>
                        {Object.entries(item).map(([key, value], i) => (
                            <td key={i} className="border px-4 py-2 border-gray-300">
                                {key.includes('created_at') || key.includes('updated_at') ? formatDate(value) : value}
                            </td>
                        ))}
                        <td className="flex justify-center border px-4 py-2 border-gray-300">
                            <Link href={`${pathname}/${data[index].id}`} className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </Link>
                            <button className="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" onClick={() => handleDelete(data[index].id)}>
                                Delete
                            </button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </>
    );
};

export default Table;
