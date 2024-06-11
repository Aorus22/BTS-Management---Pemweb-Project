import React, { ChangeEvent, Dispatch, SetStateAction, useState } from 'react';
import {router, usePage} from "@inertiajs/react";

export type DropdownOption = {
    id: number;
    nama: string;
};

export type Dropdown = {
    [key: string]: DropdownOption[];
};

export type FormDataCustom = {
    [key: string]: any;
};

interface DynamicFormProps {
    isNewForm: boolean;
    data: FormDataCustom;
    setData: Dispatch<SetStateAction<any>>;
    dropdown?: Dropdown;
}

const formatLabel = (key: string) => {
    return key.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
};

const DynamicForm: React.FC<DynamicFormProps> = ({ isNewForm, data, setData, dropdown }) => {
    const pathname = usePage().url.split('/').slice(0, 2).join('/');
    const [isEditMode, setIsEditMode] = useState(isNewForm);
    const [initialData, setInitialData] = useState<FormDataCustom>(data);

    const handleChange = (e: ChangeEvent<HTMLInputElement> | ChangeEvent<HTMLSelectElement>) => {
        const { name, value } = e.target;
        let parsedValue: any;

        if (e.target.type === "number") {
            parsedValue = Number(value);
        } else if (e.target.type === "datetime-local") {
            parsedValue = new Date(value);
        } else {
            parsedValue = value;
        }

        setData((prevData: FormDataCustom) => ({ ...prevData, [name]: parsedValue }));
    };

    const toggleEditMode = () => {
        if (isEditMode) {
            setData(initialData);
        }
        setIsEditMode(!isEditMode);
    };

    if (!data) {
        return <p className="text-center p-4">Tidak ada data yang tersedia.</p>;
    }

    const handleSubmit = () => {
        router.post(`${pathname}`, data);
    };

    const handleUpdate = () => {
        router.put(`${pathname}/${data.id}`, data)
    };

    const getInputType = (key: string): string => {
        const value = data[key];

        if (typeof value === 'number') {
            return 'number';
        } else if (typeof value === 'string') {
            return 'text';
        } else if (value instanceof Date) {
            return 'datetime-local';
        }
        return 'text';
    };

    return (
        <div>
            {!isNewForm && (
                <div className="mb-4 flex space-x-2">
                    <button
                        type="button"
                        onClick={toggleEditMode}
                        className={`px-4 py-2 ${isEditMode ? 'bg-red-500' : 'bg-blue-500'} text-white rounded`}
                    >
                        {isEditMode ? 'Cancel' : 'Edit'}
                    </button>
                    {isEditMode && (
                        <button
                            type="button"
                            onClick={handleUpdate}
                            className="px-4 py-2 bg-green-500 text-white rounded"
                        >
                            Save
                        </button>
                    )}
                </div>
            )}
            <form>
                {Object.keys(data).map((key) => (
                    <div key={key} className="mb-4">
                        <label
                            className={`block text-gray-700 text-sm font-bold mb-2 ${isNewForm && key === 'id' ? 'hidden' : ''}`}
                            htmlFor={key}>
                            {formatLabel(key)}
                        </label>
                        {dropdown && dropdown.hasOwnProperty(key) ? (
                            <select
                                name={key}
                                value={data[key]}
                                onChange={handleChange}
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                disabled={!isEditMode}
                            >
                                <option value="">Pilih {key}</option>
                                {dropdown[key].map((option: DropdownOption) => (
                                    <option key={option.id} value={option.id}>{option.nama}</option>
                                ))}
                            </select>
                        ) : (
                            <input
                                type={getInputType(key)}
                                name={key}
                                value={getInputType(key) === "datetime-local" ? (data[key].toISOString().slice(0, 16)) : (data[key])}
                                onChange={handleChange}
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                hidden={isNewForm && key === 'id'}
                                disabled={!isEditMode || key === 'id'}
                            />
                        )}
                    </div>
                ))}

                {isNewForm && (
                    <button
                        type="button"
                        onClick={handleSubmit}
                        className="px-4 py-2 bg-blue-500 text-white rounded"
                    >
                        Submit
                    </button>
                )}
            </form>
        </div>
    );
};

export default DynamicForm;
