
import React from 'react';
import { ChevronLeft, ChevronRight } from 'lucide-react';
import { getMonthMatrix, WEEK_DAYS, MONTH_NAMES, isPastDate, isToday } from '../lib/date';

interface CalendarGridProps {
    selectedDate: Date | null;
    onSelectDate: (date: Date) => void;
}

const CalendarGrid: React.FC<CalendarGridProps> = ({ selectedDate, onSelectDate }) => {
    // MVP: Only current month logic first. 
    // If we want to allow next month, we need state for shownMonth/shownYear inside here or passed down.
    // Given the prompt didn't specify multi-month explicitly but "Calendar grid mensual (mes actual)", I'll default to current Date.

    // To allow some flexibility, let's track displayed month locally
    const [currentView, setCurrentView] = React.useState(new Date());

    const year = currentView.getFullYear();
    const month = currentView.getMonth();
    const matrix = getMonthMatrix(year, month);

    const prevMonth = () => {
        // Prevent going back past current month
        const now = new Date();
        if (month > now.getMonth() || year > now.getFullYear()) {
            setCurrentView(new Date(year, month - 1, 1));
        }
    };

    const nextMonth = () => {
        // MVP limit: maybe 3 months out? Let's just allow infinite forward for now
        setCurrentView(new Date(year, month + 1, 1));
    };

    const isSameDay = (d1: Date, d2: Date | null) => {
        if (!d2) return false;
        return d1.getDate() === d2.getDate() &&
            d1.getMonth() === d2.getMonth() &&
            d1.getFullYear() === d2.getFullYear();
    };

    return (
        <div className="bg-slate-800/80 rounded-xl p-4 border border-slate-700 shadow-md">
            {/* Header */}
            <div className="flex items-center justify-between mb-4">
                <button
                    onClick={prevMonth}
                    className="p-1 hover:bg-slate-700 rounded-lg text-slate-300 disabled:opacity-30"
                    disabled={month === new Date().getMonth() && year === new Date().getFullYear()} // Block past
                >
                    <ChevronLeft className="w-5 h-5" />
                </button>
                <h3 className="text-white font-bold capitalize">
                    {MONTH_NAMES[month]} <span className="text-slate-500 text-sm ml-1">{year}</span>
                </h3>
                <button onClick={nextMonth} className="p-1 hover:bg-slate-700 rounded-lg text-slate-300">
                    <ChevronRight className="w-5 h-5" />
                </button>
            </div>

            {/* Week Days */}
            <div className="grid grid-cols-7 mb-2">
                {WEEK_DAYS.map(d => (
                    <div key={d} className="text-center text-xs font-bold text-slate-500 py-1">
                        {d}
                    </div>
                ))}
            </div>

            {/* Days Grid */}
            <div className="grid grid-cols-7 gap-1">
                {matrix.map((row, rIdx) => (
                    <React.Fragment key={rIdx}>
                        {row.map((date, cIdx) => {
                            if (!date) return <div key={`${rIdx}-${cIdx}`} className="aspect-square" />;

                            const disabled = isPastDate(date);
                            const selected = isSameDay(date, selectedDate);
                            const today = isToday(date);

                            return (
                                <button
                                    key={date.toISOString()}
                                    disabled={disabled}
                                    onClick={() => onSelectDate(date)}
                                    className={`
                                        aspect-square rounded-lg flex items-center justify-center text-sm font-medium transition-all relative
                                        ${disabled
                                            ? 'text-slate-600 opacity-50 cursor-not-allowed'
                                            : selected
                                                ? 'bg-rose-500 text-white shadow-lg shadow-rose-500/30'
                                                : 'text-slate-300 hover:bg-slate-700 hover:text-white bg-slate-800'
                                        }
                                        ${today && !selected ? 'border border-rose-500/50 text-rose-400' : ''}
                                    `}
                                >
                                    {date.getDate()}
                                    {today && <div className="absolute bottom-1 w-1 h-1 bg-current rounded-full opacity-50"></div>}
                                </button>
                            );
                        })}
                    </React.Fragment>
                ))}
            </div>
        </div>
    );
};

export default CalendarGrid;
