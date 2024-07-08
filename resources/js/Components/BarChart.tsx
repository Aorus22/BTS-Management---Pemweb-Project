import React from 'react';
import { BarChart, Bar, XAxis, YAxis, Tooltip, Legend, ResponsiveContainer } from 'recharts';

interface DataItem {
    [key: string]: number | string;
}

interface ChartProps {
    data: DataItem[];
    title: string;
    color: string;
    dataKeyX: string;
    dataKeyY: string;
    height: number
}

const ChartComponent: React.FC<ChartProps> = ({ data, title, color, dataKeyX, dataKeyY, height }) => {
    return (
        <ResponsiveContainer width="100%" height={height}>
            <BarChart
                layout="vertical"
                data={data}
                margin={{ top: 20, right: 30, left: 20, bottom: 10 }}
                barCategoryGap="20%"
            >
                <YAxis
                    dataKey={dataKeyX}
                    type="category"
                    width={150}
                />
                <XAxis type="number" />
                <Tooltip />
                <Legend />
                <Bar dataKey={dataKeyY} fill={color} name={title} />
            </BarChart>
        </ResponsiveContainer>
    );
};

export default ChartComponent;
