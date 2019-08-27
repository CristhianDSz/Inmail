export default class RecordSorter {
    static sortByDate(records = []) {
        return records.sort((a, b) => {
            return moment(b.datetime) - moment(a.datetime)
        })
    }

    static sortByStringField(records = [], field) {
        return records.sort((a, b) => {
            return a[field].toLowerCase().localeCompare(b[field].toLowerCase())
        })
    }
    /**
     * Create array for first letter pass as char ("E"), after sort for last record number segment, this is the number of sequence, ej: E019-001 --> 001, finally do the same for the other char ("S"), ej: S019-001 ---> 001 and concat the two arrays
     * @param {array} records
     * @param {string} char
     * @param {string} char
     */
    static sortByCharAndNumber(records = [], char = 'E', char2 = 'S') {
        let charRecords = []
        let char2Records = []
        records.forEach(record => {
            if (record.number.split('-')[0].charAt(0) === char) {
                charRecords.push(record)
            } else if (record.number.split('-')[0].charAt(0) === char2) {
                char2Records.push(record)
            }
        })

        const sortArray = function(records = [], prop = 'number') {
            return records.sort((a, b) => {
                return (
                    Number(a[prop].split('-')[1]) -
                    Number(b[prop].split('-')[1])
                )
            })
        }
        charRecords = sortArray(charRecords)
        char2Records = sortArray(char2Records)

        return charRecords.concat(char2Records)
    }
}
